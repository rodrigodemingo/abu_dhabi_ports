jQuery(document).ready(function($){

    /*ViewModel*/
    function MapViewModel(mapObject,mapid) {

        var self = this;

        self.mapID = mapid;
        self.MapHolder = $('#MapListPro' + self.mapID);
        self.mapCanvas = $('#map-canvas' + self.mapID);

        //Get height and width for infowindows
        self.infoWindowWidth = self.mapCanvas.width() * mapObject.options.infowidth;
        self.infoWindowHeight = self.mapCanvas.height() * mapObject.options.infoheight;

        //Sorting
        self.sortDirection = ko.observable(mapObject.options.orderdir);
        self.selectedSortType = ko.observable(mapObject.options.initialsorttype);

        //Used for unselected markers
        self.useCategoryFilter =  ko.observable(false);

        //Options
        self.maximumResults = null;

        //Location stuff
        self.geocodedLocation = ko.observable();
        self.geoenabled = (mapObject.options.geoenabled.toLowerCase() === 'true');
        self.geoHomePosition = null;

        self.userLocation = {};//new Location();

        //Default start position and zoom
        self.centrePoint = '';
        self.defaultZoom = '';

        //MANUAL LOCATION
        if (mapObject.options.startlat) {
            //If centre point doesn't exist yet set it
            if (self.centrePoint === '') {
                self.centrePoint = new google.maps.LatLng(mapObject.options.startlat, mapObject.options.startlong);
                self.defaultZoom = parseInt(mapObject.options.defaultzoom,10);
            }
        }

        self.hasZoomed = false;

        self.markers = []; //The markers container

        //Stylers
        self.customstylers = mapObject.options.customstylers;

        self.mapOptions = {
            zoom: 16,
            center: tempCentre,
            mapTypeId: google.maps.MapTypeId.ROADMAP,
            panControl: false,
            zoomControl: true,
            mapTypeControl: true,
            scrollwheel: mapObject.options.disablescroll === "false",
            scaleControl: true,
            streetViewControl: mapObject.options.streetview !== "false",
            overviewMapControl: false
        };

        if(self.customstylers !== ''){
            self.mapOptions.styles = $.parseJSON(self.customstylers);
        }

        //Directions
        self.awaitingGeoDirections = null;
        self.awaitingGeoDirectionsLocation = null;
        self.directionsType = "";
         self.directionsService = new google.maps.DirectionsService();
        self.directionsRenderer = new google.maps.DirectionsRenderer({draggable: true});

        //The chosen distance
        self.chosenFromDistance = ko.observable();

        //The dropdown menu of distances used by location search
        self.distanceFilters = [];

        //Search queries
        self.query = ko.observable('');
        self.locationquery = ko.observable('');
        self.hideuntilsearch = mapObject.options.hideuntilsearch;

        //Check if either search is fired yet
        self.anySearchTermsEntered = ko.computed(function(){
            return self.query().length > 0 || self.locationquery().length > 0;
        },this);

        //Marker for the location search failing
        self.geocodeFail = ko.observable(false);

        //Unit system
        self.unitSystemFriendly = maplistScriptParamsKo.measurementUnits == "METRIC" ? maplistScriptParamsKo.measurementUnitsMetricText : maplistScriptParamsKo.measurementUnitsImperialText;

        //Paging
        self.pageSize = ko.observable(mapObject.options.locationsperpage);   //Items per page
        self.pageIndex = ko.observable(0);  //Current page

        //GET DATA FROM JSON AND CREATE VARS AND OBJECTS
        //==============================================

        //Map the locations to KO objects
        self.mapLocations = ko.utils.arrayMap(mapObject.locations, function (item) {
            var tempItem = new Location(item);
            tempItem.distanceAway = ko.observable(null);
            tempItem.searchDistanceAway = ko.observable(null);
            return tempItem;
        });

        //Map the categories to KO objects
        self.mapCategories = ko.utils.arrayMap(mapObject.categories, function (item) {
            return new Category(item.title, item.slug);
        });

        self.customCategories = {};

        if(mapObject.allTaxonomies !== undefined){
            //Map custom categories to KO objects
            ko.utils.arrayForEach(mapObject.allTaxonomies["taxonomyLookup"], function (taxonomyName) {

                self.customCategories[taxonomyName] = ko.utils.arrayMap(mapObject.allTaxonomies[taxonomyName],function(taxonomy){
                    return new Category(taxonomy.title, taxonomy.slug, taxonomyName);
                });

            });
        }

        self.itemCategories = function(data){

            var html = '';

            // if(mapObject.options.hidefilter == "false"){
            for(var i = 0; i < data.categories.length; i++ ){
                html += "<span class='" + data.categories[i].slug + "'>" + data.categories[i].title + "</span>";
                //Add a trailing comma
                if(i != data.categories.length - 1){html += ", ";}
            }
            // }

            if(data.customCategories !== null){

                if(mapObject.options.hidefilter == "false"){
                    //Assume there is at least one regular category
                    html += ", ";
                }

                var categoryIndex = 1;

                for(var customCat in data.customCategories){
                    if (data.customCategories.hasOwnProperty(customCat)) {
                        for(var j = 0; j < data.customCategories[customCat].length; j++ ){
                            html += "<span class='" + data.customCategories[customCat][j].slug + "'>" + data.customCategories[customCat][j].name + "</span>";
                            //Add a trailing comma
                            if(j != data.customCategories[customCat].length - 1){html += ", ";}
                        }

                        //Add a trailing comma if the category had any items
                        if(data.customCategories[customCat].length > 0){
                            html += ", ";
                        }
                    }

                    categoryIndex++;
                }

                //Remove trailing comma and space (done like this rather than loop data.customcategories to get length)
                html = html.substr(0, html.length-2);
            }

            return html;
        };

        //Distance filters
        $.each(mapObject.options.searchdistances,function(index,distance){
            self.distanceFilters.push(new Distance(distance));
        });

        //Home location
        self.homelocation = mapObject.homelocation !== '' ? mapObject.homelocation : null;

        //If a home location is set make it centre
        //TODO:Don't use manual lat/lng here
        var tempCentre = self.homelocation !== null ? new google.maps.LatLng(self.homelocation.latitude, self.homelocation.longitude) : new google.maps.LatLng(51.62921, -0.7545);

        //Directions
        switch (mapObject.options.defaultdirectionsmode){
            case "WALKING" :
                self.directionsType = google.maps.TravelMode.WALKING;
                break;
            case "BICYCLING" :
                self.directionsType = google.maps.TravelMode.BICYCLING;
                break;
            case "TRANSIT" :
                self.directionsType = google.maps.TravelMode.TRANSIT;
                break;
            default :
                self.directionsType = google.maps.TravelMode.DRIVING;
                break;
        }


        /*
         * CUSTOM BINDINGS
         ===============================================*/

        /* Binding to make content appear with 'slideIn' effect */
        ko.bindingHandlers['slideIn'] = {
            'update': function(element, valueAccessor) {
                var options = valueAccessor();
                if(options() === true){
                    $(element).slideDown(300);
                }
            }
        };

        /* Binding to make content disappear with 'slideOut' effect */
        ko.bindingHandlers['slideOut'] = {
            'update': function(element, valueAccessor) {
                var options = valueAccessor();
                if(options() === false){
                    $(element).slideUp(300);
                }
            }
        };

        /*
         * EVENTS
         * Note: some events are complex and appear later in this file
         ===============================================*/

         //Force redraw of the map
         $(document).on("resizeMap",function(e){
            google.maps.event.trigger(self.map, "resize");
            self.resetMapZoom();
         });

        //Show categories list
        self.showCategories = function(data, element) {
            var thisButton = $(element.currentTarget);
            thisButton.siblings('ul').slideToggle(200);
            return false;
        };

        //Category click
        self.selectCategory = function(category, element) {
            //Hide the menu when an item is chosen
            //But not if categories are displayed as a list,
            //or the list is displayed as an accordion
            if( mapObject.options.menushideonselect &&
                mapObject.options.categoriesaslist == "false" &&
                mapObject.options.viewstyle !== 'accordion')
            {
                //Uncomment to hide category list after selecting
                $(element.target).closest('ul').slideUp();
            }


            //If the clicked item is expanded then hide it, otherwise show it
            category.selected(!category.selected());

            //If in exlusive mode hide all others
            //Only allow one selection at a time
            if(mapObject.options.categoriesmultiselect == "false"){
                //de-select all categories
                ko.utils.arrayForEach(self.mapCategories, function(item) {
                    if(item !== category){
                        item.selected(false);
                    }
                });
            }


            if(self.selectedCategories().length > 0){
                self.useCategoryFilter(true);
            }
            else{
                self.useCategoryFilter(false);
            }

        };

        self.selectedCategories = function(){

            var selCat = ko.utils.arrayFilter(self.mapCategories, function(item) {
                return item.selected();
            });


            return selCat;
        };

        self.showCustomCategoriesClick = function(data,element){
            var thisButton = $(element.currentTarget);
            thisButton.siblings('ul').slideToggle(200);
        };

        //Category click
        self.selectCustomCategory = function(data,event) {

            //EACH TERM
            ko.utils.arrayForEach(self.customCategories[data.taxonomyName],function(term){
                if(data.slug === term.slug){
                    term.selected(!term.selected());
                }
            });

            //Hide the menu when an item is chosen
            if(mapObject.options.menushideonselect){
                //Uncomment to hide category list after selecting
                $(event.target).closest('ul').slideUp();
            }
        };


        //Geolocation stuff
        //=========================
        //See if geo is neededmap
        if (self.geoenabled === true && navigator.geolocation)
        {
            //Check to see available (from another map)
            if(self.geoHomePosition === null){
                navigator.geolocation.getCurrentPosition(getGeo,getGeoError);
            }
            else{
                getGeo(self.geoHomePosition);
            }
        }
        else{
            //If geo enabled but no navigator (<ie8)
            if(self.geoenabled === true){
                getGeoError();
            }
        }


        /*
        * Takes a list of locations and a lat/lng and updates them with the distance away for each
        */
        function updateAllLocationsWithDistanceFrom(locationList,fromLat,fromLng){
            //Loop over all of the locations and add a distance to each of them
            ko.utils.arrayForEach(locationList, function(location) {
                var distanceAway = calculateDistance(location.latitude,location.longitude,fromLat,fromLng);
                location.distanceAway(distanceAway);
            });
        }

        //Get the geocoded location for the user
        //This is used for onLoad geo and for directions geo
        function getGeo(position)
        {
            //Set the global var for this first time through
            if(self.geoHomePosition === null){
                self.geoHomePosition = {latitude : position.coords.latitude, longitude : position.coords.longitude};
            }

            //If geo is for directions
            if(self.awaitingGeoDirections !== null){
                self.showDirections(self.geoHomePosition.latitude + ',' + self.geoHomePosition.longitude,self.awaitingGeoDirectionsLatLng,self.awaitingGeoDirections);
                self.awaitingGeoDirections = null;
                self.awaitingGeoDirectionsLatLng = null;
            }
            else{
                //Loop over all of the locations and add a distance to each of them
                updateAllLocationsWithDistanceFrom(self.mapLocations,position.coords.latitude,position.coords.longitude);

                //Set sort to distance
                self.selectedSortType('distance');

                //Fire a sort now
                self.sortList('distance');
            }

            //Put a marker on the map for the geocoded location
            showGeoMarker(position.coords.latitude,position.coords.longitude);
        }



        //Fallback geolocate uses ip location
        function getGeoError(position)
        {
            $.getJSON("http://www.geoplugin.net/json.gp?jsoncallback=?",
                function (data) {

                    //Set the global var for this first time through
                    if(self.geoHomePosition === null) {
                        self.geoHomePosition = { latitude: data['geoplugin_latitude'], longitude: data['geoplugin_longitude'] };
                    }

                    //If geo is for directions
                    if(self.awaitingGeoDirections !== null){
                        self.showDirections(self.geoHomePosition.latitude + ',' + self.geoHomePosition.longitude,self.awaitingGeoDirectionsLatLng,self.awaitingGeoDirections);
                        self.awaitingGeoDirections = null;
                        self.awaitingGeoDirectionsLatLng = null;
                    }
                    else{
                        //Loop over all of the locations and add a distance to each of them
                        updateAllLocationsWithDistanceFrom(self.mapLocations,data['geoplugin_latitude'],data['geoplugin_longitude']);

                        //Set sort to distance
                        self.selectedSortType('distance');
                        //Fire a sort now
                        self.sortList('distance');
                    }

                    showGeoMarker(self.geoHomePosition.latitude,self.geoHomePosition.longitude);
                }
            );
        }

        /*
        * Put a marker on the map for the geocoded location
        */
        function showGeoMarker(lat,lng){
            //Create marker for geo
            if(!self.userLocation._mapMarker){

                var position = new google.maps.LatLng(lat, lng);
                var mapToUse = self.map;

                //Create marker
                //-----------------------------
                var marker = new google.maps.Marker({
                        map: mapToUse,
                        position: position,
                        content: '',
                        optimized: false,
                        animation: google.maps.Animation.DROP
                });

                //Set the marker
                //-----------------------------
                self.userLocation._mapMarker = marker;
            }

            //Show this location
            self.userLocation._mapMarker.setAnimation(google.maps.Animation.DROP);
            self.userLocation._mapMarker.setVisible(true);
            self.resetMapZoom();
        }

        //Fix an issue with markerclusterer
        //https://code.google.com/p/google-maps-utility-library-v3/issues/detail?id=252
        function updateClusterer(){

            if (mapObject.options.clustermarkers == 'true') {

                ko.utils.arrayForEach(self.filteredLocations.peek(), function(location) {
                    self.markerClusterer.addMarker(location._mapMarker);
                });

                var mapcenter = self.map.getCenter();

                if(mapcenter){
                    self.map.setCenter(new google.maps.LatLng((mapcenter.lat() + 0.0000001), mapcenter.lng()));
                }
            }
        }

       /*
         * This makes sure all markers are in view when the homelocationid is set as centre
         * Can't use fitbounds as that doesn't allow a centre to be specified
         */
        var fitToMarkers = function(markers) {

            //Start full zoomed in
            var currentZoom = 21;

            //Zoom the map all the way in
            self.map.setZoom(currentZoom);

            //Check each marker
            for (var i = 0; i < markers.length; i++) {

                //If this marker isn't in view, zoom out one step
                while(!self.map.getBounds().contains(markers[i].getPosition()) && currentZoom > 1){
                    currentZoom = currentZoom - 1;
                    self.map.setZoom(currentZoom);
                }

            }

            //Stop the zoom from getting too close
            if(currentZoom > 16){
                self.map.setZoom(16);
            }

            return currentZoom;
        };



        /*
         * MAP FUNCTIONALITY
         *
         ==========================================*/

        if (mapObject.options.viewstyle != 'listonly') {

            //Create a map
            self.map = new google.maps.Map(self.mapCanvas[0], self.mapOptions);


            //add Open Street Map
            self.map.mapTypes.set("OSM", new google.maps.ImageMapType({
                getTileUrl: function (coord, zoom) {
                        return "http://tile.openstreetmap.org/" + zoom + "/" + coord.x + "/" + coord.y + ".png";
                },
                tileSize: new google.maps.Size(256, 256),
                name: "Open Street Map",
                maxZoom: 18
            }));

            //Get default zoom level after bounds updated
            if (mapObject.options.viewstyle != 'listonly') {

                //Set centrepoint for future use (no results found etc.)
                //Fitbounds happens async so need this to get zoom
                var boundsChangeBoundsListener = google.maps.event.addListenerOnce(self.map, 'bounds_changed', function (event) {

                    if (!self.defaultZoom) {
                        self.defaultZoom = self.map.getZoom();

                        //If home mode make it centre
                        if(self.homelocation){
                            self.centrePoint = new google.maps.LatLng(self.homelocation.latitude, self.homelocation.longitude);
                            self.map.setCenter(self.centrePoint);

                            self.defaultZoom = fitToMarkers(self.markers);


                        }
                        else{
                            //Otherwise get the centrepoint from the current zoomed bounds
                            self.centrePoint = self.map.getCenter();
                        }
                    }
                });

                // Listen for user click on map to close any open infowindows
                google.maps.event.addListener(self.map, "click", function () {
                    self.infowindow.close();
                });
            }

            //INITIAL MAP TYPE
            var mapTypeIdToUse;

            switch (mapObject.options.initialmaptype.toLowerCase()) {
                case "hybrid":
                    mapTypeIdToUse = google.maps.MapTypeId.HYBRID;
                    break;
                case "roadmap":
                    mapTypeIdToUse = google.maps.MapTypeId.ROADMAP;
                    break;
                case "satellite":
                    mapTypeIdToUse = google.maps.MapTypeId.SATELLITE;
                    break;
                case "osm":
                    mapTypeIdToUse = 'OSM';
                    break;
                default:
                    mapTypeIdToUse = google.maps.MapTypeId.HYBRID;
                    break;
            }

            //Pass the map type into the Google map
            self.map.setOptions({
                mapTypeControlOptions: {
                    mapTypeIds: [
                                google.maps.MapTypeId.ROADMAP,
                                google.maps.MapTypeId.SATELLITE,
                                'OSM'
                            ],

                    style: google.maps.MapTypeControlStyle.DROPDOWN_MENU
                },
                mapTypeId : mapTypeIdToUse
            });

            //MARKER CLUSTERING
            //Create marker clusterer if needed
            if (mapObject.options.clustermarkers == 'true') {
                var mcOptions = {
                    gridSize: parseInt(mapObject.options.clustergridsize,10),
                    maxZoom: parseInt(mapObject.options.clustermaxzoomlevel,10)
                };

                self.markerClusterer = new MarkerClusterer(self.map,[],mcOptions);
            }

            //HOME LOCATION
            //If home location set create the marker for it
            if(self.homelocation !== null){

                if(self.homelocation._mapMarker !== undefined){

                    var image = new google.maps.MarkerImage(
                        self.homelocation.pinImageUrl
                    );

                    var position = new google.maps.LatLng(self.homelocation.latitude, self.homelocation.longitude);
                    var mapToUse = self.map;

                    //Create marker
                    //-----------------------------
                    var marker = new google.maps.Marker({
                            map: mapToUse,
                            position: position,
                            title: self.homelocation.title,
                            content: '',
                            icon: image,
                            optimized: false,
                            animation: google.maps.Animation.DROP
                    });

                    //Set the marker
                    //-----------------------------u
                    self.homelocation._mapMarker = marker;
                 }

                //Show this location
                self.homelocation._mapMarker.setAnimation(google.maps.Animation.DROP);
                self.homelocation._mapMarker.setVisible(true);
            }

            /*
             * INFOBOXES
             */
            //If infoboxes are switched off
            if(maplistScriptParamsKo.disableInfoBoxes == 'true'){
                self.infoBoxOptions = {maxWidth : self.infoWindowWidth};
                self.infowindow = new google.maps.InfoWindow(self.infoBoxOptions);
            }
            else{
                //Infobox switched on
                self.infoBoxOptions = {
                    alignBottom: true,
                    content: "",
                    disableAutoPan: false,
                    closeBoxMargin: "10px 2px 2px 2px",
                    closeBoxURL: "http://www.google.com/intl/en_us/mapfiles/close.gif",
                    enableEventPropagation: false,
                    infoBoxClearance: new google.maps.Size(40, 40),
                    isHidden: false,
                    pane: "floatPane",
                    zIndex: 1500
                };

                if(maplistScriptParamsKo.infoboxtype === "bubble"){
                    //InfoBubble
                    self.infoBoxOptions.backgroundClassName = "infoWindowContainer infobubble";
                    self.infoBoxOptions.minHeight = self.infoWindowWidth;
                    self.infoBoxOptions.maxHeight = self.infoWindowWidth;
                    self.infoBoxOptions.minWidth = self.infoWindowHeight;
                    self.infoBoxOptions.maxWidth = self.infoWindowHeight;
                    self.infoBoxOptions.padding = 0;

                    self.infowindow = new InfoBubble(self.infoBoxOptions);
                }
                else{
                    //Infobox
                    self.infoBoxOptions.boxClass = "infoWindowContainer infobox";
                    self.infoBoxOptions.pixelOffset = new google.maps.Size((self.infoWindowWidth /2) * -1, -40);
                    self.infoBoxOptions.boxStyle = {
                        width:  self.infoWindowWidth + "px"
                    };

                    self.infowindow = new InfoBox(self.infoBoxOptions);
                }

            }

            //Catch the Close event of the infowindow
            google.maps.event.addListener(self.infowindow, 'closeclick', function () {
                //If set not to zoom out again leave as it is
                if(mapObject.options.keepzoomlevel != 'true'){
                    self.resetMapZoom();
                }

                //Close all of the locations
                self.closeAllLocations();

            });
        }



        //Reset all
        //=====================
        self.resetAll = function() {
            //clear search
            self.query('');
            self.locationquery('');
            self.geocodeFail(false);

            //Reset bounds
            self.bounds = '';

            //Clear out zoom marker
            self.hasZoomed = false;

            //de-select all categories
            ko.utils.arrayForEach(self.mapCategories, function(item) {
                item.selected(mapObject.options.categoriesticked == 'true');
            });

            //Deselect all items as filtering only kicks in when none selected
            $.each(self.customCategories,function(index,thiscategory){
                $.each(thiscategory,function(index,term){
                    term.selected(false);
                });
            });

            //Close all of the locations that are open
            self.closeAllLocations();

            //Ignore categories again
            self.useCategoryFilter(false);

                //Clear directions
                $('.mapLocationDirectionsHolder',self.MapHolder).html('');
                //Clear the map set on the directions renderer
                self.directionsRenderer.setMap(null);

            self.infowindow.close();
        };

        /*
         * Close all currently open locations
         */
        self.closeAllLocations = function(){

            //Close all of the locations
            $.each(self.mapLocations,function(index, thislocation){
                thislocation.expanded(false);
            });

            self.infowindow.close();
        };


        //Search
        //======================================

        //Search distance
        function Distance(value) {
            if (maplistScriptParamsKo.measurementUnits == 'METRIC') {
                this.label = value + ' ' + maplistScriptParamsKo.measurementUnitsMetricText;
            }
            else{
                this.label = value + ' ' + maplistScriptParamsKo.measurementUnitsImperialText;
            }

            //If combo search
            if (mapObject.options.simplesearch === 'combo') {
                this.label = maplistScriptParamsKo.distanceWithinText + ' ' + this.label + ' ' + maplistScriptParamsKo.distanceOfText;
            }

            this.value = value;
        }


        /*
        * SEARCH
        *
        ==========================================*/

        //see if search params passed to page
        var terms = getParameterByName('locationSearchTerms');
        var textSearchTerms = getParameterByName('textSearchTerms');//Only needed if combo
        var searchDistance = getParameterByName('searchDistance');

        //TODO:Update to handle combo search
        //If search terms found
        if(terms || textSearchTerms){
            //Query object for search
            if (mapObject.options.simplesearch == 'true') {
                self.query(terms);
            }
            else{

                //See if there is a text search as well
                if(textSearchTerms){
                    self.query(textSearchTerms);
                }

                //Allow a form to pass the searchdistance in
                if(searchDistance){
                    self.chosenFromDistance(parseInt(searchDistance,10));
                }

                var geocoder = new google.maps.Geocoder();
                var address = terms;

                //Add default country if set
                if (mapObject.options.country !== '') {
                    address = address + ', ' + mapObject.options.country;
                }

                //TODO:Can this ever be not defined?
                if (geocoder) {
                    geocoder.geocode({ 'address': address }, function (results, status) {
                       if (status == google.maps.GeocoderStatus.OK) {
                            //We got an address back so set this
                            self.geocodedLocation({lat:results[0].geometry.location.lat(),lng:results[0].geometry.location.lng()});
                            //Set the query string for checking
                            self.locationquery(address);
                            self.sortDirection('dec');
                            self.selectedSortType('distance');
                            self.sortList('distance');
                            self.geocodeFail(false);
                       }
                       else {
                           //Geocode fail
                           self.geocodeFail(true);
                           //TODO:Add front end message here for failure?
                          console.log("Geocoding failed: " + status);
                       }
                    });
                 }
            }
        }

        //Search form submit
        this.mapSearchSubmit = function(formElement){

            var formSubmitted = $(formElement);

            document.activeElement.blur();

            //Blue the form so the ios keyboard hides
            formSubmitted.blur();

            $('html, body').animate({
                scrollTop: self.MapHolder.offset().top - 20
            }, 200);

            //Click the search button if there is one
            $('.doPrettySearch',formSubmitted).click();

        };

        //Update location search
        self.locationSearch = function(data,element){

            //Get the text from the search box
            var locationTerms = ($(element.currentTarget).siblings('.prettySearchValue')).val();

            //Create a geocoder to send to Google
            var geocoder = new google.maps.Geocoder();

            //Add default country if set
            if (mapObject.options.country !== '') {
                locationTerms = locationTerms + ', ' + mapObject.options.country;
            }

            //Make sure geocode exists and send it on
            if (geocoder) {
                geocoder.geocode({ 'address': locationTerms }, function (results, status) {
                   if (status == google.maps.GeocoderStatus.OK) {
                       //We got an address back so set this
                       self.geocodedLocation({lat:results[0].geometry.location.lat(),lng:results[0].geometry.location.lng()});
                        //TODO:Drop a search location pin n

                       //Set the query string for checking
                       self.locationquery(locationTerms);
                        //Set sort to distance
                        self.sortDirection('dec');
                        self.selectedSortType('distance');
                        self.sortList('distance');
                   }
                   else {
                       //Geocode fail
                       //TODO:Add front end message here for failure?
                       //Geocode fail
                       console.debug("FAILED");
                       self.geocodeFail(true);
                      console.log("Geocoding failed: " + status);

                   }
                });
             }
        };

        //Update combo search
        self.comboSearch = function(data,element){
            var searchTerms = ($(element.currentTarget).siblings('.prettySearchValue')).val();

            //Add this check for ie9 placeholder issues
            var searchTermsPlaceHolder = ($(element.currentTarget).siblings('.prettySearchValue')).attr('placeholder');
            if(searchTerms == searchTermsPlaceHolder){
                searchTerms = '';
            }

            var locationTerms = ($(element.currentTarget).siblings('.prettySearchLocationValue')).val();

            //Add this check for ie9 placeholder issues
            var locationTermsPlaceHolder = ($(element.currentTarget).siblings('.prettySearchLocationValue')).attr('placeholder');
            if(locationTerms == locationTermsPlaceHolder){
                locationTerms = '';
            }

            var geocoder = new google.maps.Geocoder();

            //Add default country if set
            if (mapObject.options.country !== '' && locationTerms.length > 0) {
                locationTerms = locationTerms + ', ' + mapObject.options.country;
            }

            if (geocoder && locationTerms.length > 0) {
                geocoder.geocode({ 'address': locationTerms }, function (results, status) {
                   if (status == google.maps.GeocoderStatus.OK) {
                       //We got an address back so set this
                       self.geocodedLocation({lat:results[0].geometry.location.lat(),lng:results[0].geometry.location.lng()});
                       //Set the query string for checking
                       self.locationquery(locationTerms);

                       self.query(searchTerms);
                        //Set sort to distance
                        self.sortDirection('dec');
                        self.selectedSortType('distance');
                        self.sortList('distance');
                   }
                   else {
                       //Geocode fail
                       //TODO:Add front end message here for failure?
                      console.log("Geocoding failed: " + status);
                      //Fallback to just text
                      self.query(searchTerms);
                   }
                });
             }
             else{
                 self.query(searchTerms);
             }
        };

        //NOTE: Add the following to delay search .extend({ throttle: 500 });

        //Clear search
        self.clearSearch = function() {
            $('.prettySearchValue', self.MapHolder).val('');
            if ($('.prettySearchLocationValue', self.MapHolder).length) {
                $('.prettySearchLocationValue', self.MapHolder).val('');
            }

            self.resetAll();
        };



        //LOCATION CLICK
        //======================================
        self.locationClick = function(location,element){

            //Uncomment to make item click go straight to detail
            // window.location.href = location.locationUrl;
            // return false;

            //Get elements we need
            var targetItem =  $(element.currentTarget);
            var clickedItem =  $(element.target);
            var parentItem = clickedItem.closest('.mapLocationDetail');
            var mapLocationDetail = targetItem.children('.mapLocationDetail');

            //If this is a link in the detail area then exit
            if(parentItem.length){ return true; }

            //Find out if this is an already showing item
            if(location.expanded() === false){

                //Close all locations initially except current
                $.each(self.mapLocations,function(index, thislocation){
                    thislocation.expanded(false);
                });

                if(mapObject.options.viewstyle != 'listonly'){
                    //Show the infowindow
                    self.showInfoWindow(location);
                }

            }
            else{

                if (mapObject.options.viewstyle != 'listonly') {

                    //Reverse the show status
                    self.infowindow.close();

                    if(mapObject.options.keepzoomlevel != 'true'){
                        self.resetMapZoom();
                    }
                }

                //Clear directions
                (targetItem.find('.mapLocationDirectionsHolder')).html('');
                //Clear the map set on the directions renderer
                self.directionsRenderer.setMap(null);

            }

            location.expanded(!location.expanded());

        };



        //Sorting
        //===================
        //This can be called by other methods like geo or search so element
        //may be empty, but sortType will be distance
        self.sortList = function(sortType, element) {

            var thisButton = null;

            if(element !== null && element !== undefined){
                thisButton = $(element.currentTarget);
                sortType = thisButton.data('sorttype');
            }

            //Make the sort fire
            if (sortType == self.selectedSortType()) {
                //No change to type
                //...so change direction

                self.sortDirection(self.sortDirection() == 'asc' ? 'dec' :  'asc');

            } else {
                self.selectedSortType(sortType);
                self.sortDirection('asc');
            }

            //Update UI
            if(thisButton !== null){

                //Reverse arrow
                if(thisButton.hasClass('showSortingBtn')){
                    thisButton.toggleClass('sortAsc');
                }
                else{
                    $('li a',thisButton.parent().parent()).removeClass('selected sortAsc');
                    thisButton.addClass(self.sortDirection() == 'asc' ? 'sortAsc selected' :  'sortDec selected');
                }


            }else{
                //Go get the button if distance sort as this can be called by other functions
                if(self.selectedSortType() == 'distance'){
                    var distanceSortButton = $(".prettyFileSorting li:nth-child(2) a",self.MapHolder);
                    if(distanceSortButton.length){
                        distanceSortButton.toggleClass('sortAsc');
                    }
                }
            }

            //Hide the menu when an item is chosen
            if(mapObject.options.menushideonselect){
                //Uncomment to hide category list after selecting
                if($(element).length){
                    $(element.target).closest('ul').slideUp();
                }
            }

        };



        //Get directions
        //===================
        self.getDirectionsClick = function(location,element){

           var thisButton = $(element.currentTarget);
           var endLocation = location.latitude + ',' +  location.longitude;

           //Uncomment this to enable directions to address rather than lat/lng
           //var endLocation = $(location.address).text();

           //If geo
           if(thisButton.hasClass('getdirectionsgeo')){

               //See if home set already
               if(self.geoHomePosition !== null){
                   //from,to,button
                   self.showDirections(self.geoHomePosition.latitude + ',' + self.geoHomePosition.longitude,endLocation,thisButton);
               }
               else{

                    self.awaitingGeoDirections = thisButton;
                    self.awaitingGeoDirectionsLatLng = endLocation;

                    //See if geo is needed
                    if (navigator.geolocation)
                    {
                        //Check to see available (from another map)
                        if(self.geoHomePosition === null){
                            navigator.geolocation.getCurrentPosition(getGeo,getGeoError);
                            // navigator.geolocation.getCurrentPosition(getGeo,getGeoError,{'enableHighAccuracy':true,'timeout':10000,'maximumAge':0});
                        }
                        else{
                            getGeo(self.geoHomePosition);
                        }
                    }
                    else{
                        //If geo enabled but no navigator (<ie8)
                        getGeoError();
                    }
               }

           }
           else{
                //The start/end locations
                var locationEntryField = thisButton.siblings('.directionsPostcode');
                var startLocation = locationEntryField.val();

                //If no location entered show error
                if(startLocation === ''){
                    locationEntryField.addClass('error');
                }
                else{
                    locationEntryField.removeClass('error');
                    //Show directions with our data
                    self.showDirections(startLocation,endLocation,thisButton);
                }


           }

           return false;
        };

        /*
         * Show the directions in thee list item
         */
        self.showDirections = function(from, to, buttonClicked) {
            if (mapObject.options.viewstyle != 'listonly') {
                //Link Renderer to the map
                self.directionsRenderer.setMap(self.map);
            }

            //The directions list div
            var directionsHolder = buttonClicked.siblings('.mapLocationDirectionsHolder');

            //Measurement units to use
            var unitSystem;
            if (maplistScriptParamsKo.measurementUnits == "METRIC") {
                unitSystem = google.maps.UnitSystem.METRIC;
            } else {
                unitSystem = google.maps.UnitSystem.IMPERIAL;
            }

            //Request object
            var request = {
                origin: from,
                destination: to,
                travelMode: self.directionsType,
                unitSystem: unitSystem
            };

            self.directionsRenderer.setPanel(directionsHolder[0]);

            self.directionsService.route(request, function(response, status) {
                if (status == google.maps.DirectionsStatus.OK) {
                    self.directionsRenderer.setDirections(response);
                    //Don't add the print button twice
                    if(!$(directionsHolder[0]).next().hasClass('printDirections')){
                        $(directionsHolder[0]).after('<a href="#" class="printDirections corePrettyStyle">' + maplistScriptParamsKo.printDirectionsMessage + '</a>');
                    }

                    //hide the infowindow
                    self.infowindow.close();
                } else {
                    console.log(status);
                }
            });
        };

        //TEXT SEARCH
        self.getLocationsWithMatchingTerm = function(locations,searchTerm){

            return ko.utils.arrayFilter(locations, function(location) {
                var textFound = false;

                //Search title and description
                if(location.title.toLowerCase().indexOf(searchTerm) != -1 || location.description.toLowerCase().indexOf(searchTerm) != -1 ){
                    textFound = true;
                }

                //Search categories
                $.each(location.categories, function(index, locationCat) {
                    if (locationCat.title.toLowerCase().indexOf(searchTerm) != -1) {
                        textFound = true;
                    }
                });

                if(textFound === true){ return location;}

            });
        };

        //LOCATION SEARCH
        self.getLocationsByDistance = function(locations,geocodedLocation){
            return ko.utils.arrayFilter(locations, function(location) {
                var distanceAway = calculateDistance(location.latitude,location.longitude,geocodedLocation.lat,geocodedLocation.lng);

                location.searchDistanceAway(distanceAway);

                 if(parseInt(location.searchDistanceAway(),10) < self.chosenFromDistance()){return location;}
            });
        };

        self.getLocationsByCategory = function(slug, locations){

            locations = locations || self.filteredLocations();

            var locationsForCat = ko.utils.arrayFilter(locations, function(location){

                var matchedByCategory = ko.utils.arrayFilter(location.categories, function(category){
                    if(category.slug.toLowerCase() === slug.toLowerCase()){
                        return true;
                    }

                    return false;
                });

                return matchedByCategory.length !== 0;
            });

            return locationsForCat;
        };


        self.getInfoWindowPart = function(partName,location){

            switch(partName){
                case "title":
                    return "<h3>" + location.title + "</h3>";
                    // break;
                case "titlelink":
                    if (location.locationUrl !== '' && maplistScriptParamsKo.hideviewdetailbuttons != 'true') {
                        return "<h3><a href='" + location.locationUrl + "'>" + location.title + "</h3>";
                    }
                    break;
                case "thumbnail":
                    return location.imageUrl ? "<img src='" + location.imageUrl + "' class='locationImage'/>" : "";
                    // break;
                case "description":
                    return location.description;
                    // break;
                case "simpledescription":
                    return location.simpledescription;
                    // break;
                case "categories":
                    return "<div>" + self.itemCategories(location) + "</div>";
                    // break;
                case "address":
                    return "<div class='address'>" + location.address + "</div>";
                    // break;
                default :
                    return "";
                    // break;
            }

        };

        //Show the infowindow
        self.showInfoWindow = function(location) {

            //Don't show if the infowindow is set to hidden
            if(mapObject.options.hideinfowindow === "true"){return;}

            var marker = location._mapMarker;
            var position = new google.maps.LatLng(location.latitude, location.longitude);

            var content = "<div class='infoWindow'>";

                //Make the title a link to the page
                if (location.locationUrl !== '' && maplistScriptParamsKo.hideviewdetailbuttons != 'true') {
                   content += "<h3><a href='" + location.locationUrl + "'>" + location.title + "</h3>";
                }
                else{
                if(mapObject.options.infoboxparts[0] === "title"){
                    content += "<h3>" + location.title + "</h3>";
                }
                }

                content += '<div class="infowindowContent" style="max-height:' + self.infoWindowHeight + 'px">';

                    $.each(mapObject.options.infoboxparts,function(index,partName){

                        //Title in first slot becomes window title and is handled above
                        if(index === 0 && partName === "title"){return;}

                        content += self.getInfoWindowPart(partName,location);
                    });

                    if (location.locationUrl !== '' && maplistScriptParamsKo.hideviewdetailbuttons != 'true') {
                        content += "<a class='viewLocationPage btn corePrettyStyle' " + (mapObject.options.openinnew === false ? "" : "target='_blank'") + " href='" + location.locationUrl + "' >" + maplistScriptParamsKo.viewLocationDetail + "</a>";
                    }

                content += "</div>";
            content += "</div>";

            self.infowindow.position = location._mapMarker.getPosition();

            self.infowindow.setContent(content);


            //If setzoomlevel is set then start to zoom
            //if keepzoomlevel is set then marked as zoomed once
            //clear this setting on clear locations
            if(mapObject.options.keepzoomlevel == 'true' && self.hasZoomed === true){
                //do nothing
            }
            else{
                if (mapObject.options.selectedzoomlevel !== ''){
                    self.map.setZoom(parseInt(mapObject.options.selectedzoomlevel,10));

                    //Mark to show we've zoomed once
                    self.hasZoomed = true;
                }
            }

            //Move to marker
            //self.map.panTo(position);
            self.infowindow.open(self.map, marker);
            return true;
        };

        //Main loop
        //===========================

        //Filtered locations
        self.filteredLocations = ko.computed(function () {

            //Search query
            var locations = self.mapLocations;
            var geocodedLocation = self.geocodedLocation();
            var search = self.query().toLowerCase();

            if(self.anySearchTermsEntered()){

                //TEXT SEARCH
                if (mapObject.options.simplesearch == 'true') {
                    locations = self.getLocationsWithMatchingTerm(locations,search);
                }
                else if (mapObject.options.simplesearch == 'false') {
                    //LOCATION SEARCH
                    locations = self.getLocationsByDistance(locations,geocodedLocation);
                }
                else{
                    //COMBO SEARCH
                    if(self.locationquery().length > 0){
                        //LOCATION SEARCH
                        locations = self.getLocationsByDistance(locations,geocodedLocation);
                    }

                    //TEXT SEARCH
                    locations = self.getLocationsWithMatchingTerm(locations,search);
                }
            }
            else{
                //HOME LOCATION SET
                //Check to see if homelocation set as we use this for distance calc
                if(self.homelocation !== null){

                    ko.utils.arrayForEach(locations, function(location) {
                        var distanceAway = calculateDistance(location.latitude,location.longitude,self.homelocation.latitude,self.homelocation.longitude);
                        location.distanceAway(distanceAway);
                    });

                    //Sort by distance  by default
                    self.sortDirection('asc');
                    self.selectedSortType('distance');

                }
            }

            //CATEGORY FILTERING
            //===========================

            //Only filter if one (or more) has been selected
            if(self.useCategoryFilter() === true){

                locations =  ko.utils.arrayFilter(locations,function(location){
                    var found = false;

                    //Get all selected categories
                    var selectedCategories = ko.utils.arrayFilter(self.mapCategories, function(category) {
                        if (category.selected()) { return category; }
                    });

                    //loop selectedCategories
                    $.each(selectedCategories, function(index, category) {

                        //loop location categories
                        $.each(location.categories, function(index, locationCat) {
                            //See if this location is in this category
                            if (category.slug == locationCat.slug) {
                                //categorisedLocations.push(location);
                                found = true;
                                return false;
                            }
                        });

                        // //Break out of outer loop
                        // if (found) {
                        //     return false;
                        // }

                    });

                    if(found){
                        return location;
                    }
                });
            }


            //Custom category filtering
            //====================================

            if(mapObject.allTaxonomies !== undefined){
                var selectedCategories = [];

                //Get all categories with at least one item selected
                 $.each(mapObject.allTaxonomies["taxonomyLookup"], function(index, taxonomyName) {

                    //Get all selected terms for current custom taxonomy - uses arrayfirst so it quits after one found
                    var hasSelected = ko.utils.arrayFirst(self.customCategories[taxonomyName], function(term) {
                        if (term.selected()) { return term; }
                    });

                    if(hasSelected !== null){
                        selectedCategories.push(self.customCategories[taxonomyName]);
                    }
                });


                //Filter by selected categories
                //=============================

                //Loop over locations
                locations =  ko.utils.arrayFilter(locations,function(location){

                    var found = true;
                    var foundInTaxonomy = false;

                    //TODO: Recursive search would be quickest here
                    ///function(locationList,termList)

                    //Loop the selected categories and see if they're selected
                    $.each(selectedCategories,function(index,customTermArray){

                        //Loop over the terms in this category
                        ko.utils.arrayForEach(customTermArray,function(customTerm){

                            //Not a selected term so quit
                            if(!customTerm.selected()){return;}

                            var foundInLocation = ko.utils.arrayFirst(location.customCategories[customTerm.taxonomyName],function(thisLocation){

                                //See if this location is in this category
                                if (customTerm.slug === thisLocation.slug) {
                                    return thisLocation;
                                }

                            });

                            //Found in this location
                            foundInTaxonomy = foundInLocation !== null;

                        });

                        //If not found in this category then this location should be hidden
                        if (foundInTaxonomy === false) {
                            found = false;
                        }


                    });

                    //Made it through all checks and is still found
                    if(found === true){
                        return location;
                    }

                });
            }

            //Update the distance text on each location
            $.each(locations,function(index,location){

                var distanceTypeToUse = null;

                //Also set distance text in same query to avoid looping twice
                if (self.locationquery()) {
                    distanceTypeToUse = location.searchDistanceAway();

                } else {
                    //Don't show distance on non-geo maps
                    if ((self.geoenabled === true || (self.homelocation !== null)) && location.distanceAway()) {
                        //Show distance from home
                        distanceTypeToUse = location.distanceAway();
                    }
                }

                //Show distance if set
                location.friendlyDistance(distanceTypeToUse === null ? '' : ' (' + distanceTypeToUse + ' ' + self.unitSystemFriendly + ')');
            });

            //Sort by sort selection
            if(self.sortDirection() == 'asc' && self.selectedSortType() == 'title'){
                locations.sort(asc_bytitle);
            }
            else if(self.sortDirection() == 'dec' && self.selectedSortType() == 'title'){
                locations.sort(dec_bytitle);
            }
            else if(self.sortDirection() == 'asc' && self.selectedSortType() == 'distance'){
                locations.sort(asc_bydistance);
            }
            else if(self.sortDirection() == 'dec' && self.selectedSortType() == 'distance'){
                locations.sort(dec_bydistance);
            }
            else if(self.selectedSortType() === 'category'){
                locations.sort(asc_bycategorymanual);
            }
            else if(self.selectedSortType() === 'categorytitle'){
                locations.sort(asc_bycategorytitle);
            }

            //Reduce results number if needed
            if (mapObject.options.limitresults != -1) {
                locations = locations.slice(0, parseInt(mapObject.options.limitresults,10));
            }

            //Reset paging
            self.pageIndex(0);

            //If only one result expand it
            if (locations.length == 1) {

                if(mapObject.options.expandsingleresult !== "false"){
                    locations[0].expanded(true);
                }
            }

            // //TEST
            // var locatbycat = self.getLocationsByCategory('samstag',locations);
            if(self.hideuntilsearch && !self.anySearchTermsEntered()){
                return [];
            }

            return locations;

        }, self,{deferEvaluation : true}).extend({ throttle: 10 });

        //Map binding
        //============================
        ko.bindingHandlers.map = {
            update: function (element, valueAccessor, allBindingsAccessor, viewModel) {

                // First get the latest data that we're bound to
                var value = valueAccessor();
                var search = viewModel.query();
                // Next, whether or not the supplied model property is observable, get its current value
                var valueUnwrapped = ko.utils.unwrapObservable(value);

                //if(valueUnwrapped.length <= 0){ return []; }

                //Hide all markers
                $.each(viewModel.mapLocations, function (index, location) {
                    if (location._mapMarker) {
                        location._mapMarker.setVisible(false);
                    }
                });


                //Loop all locations
                $.each(valueUnwrapped, function (index, location) {
                    //if marker is not already set on the location
                    if(!location._mapMarker){
                        var image = new google.maps.MarkerImage(
                            location.pinImageUrl
                        );

                        var position = new google.maps.LatLng(location.latitude, location.longitude);
                        var mapToUse = self.map;

                        if (mapObject.options.clustermarkers == 'true') {
                            mapToUse = null;
                        }

                        //Create marker
                        //-----------------------------
                        var marker = new google.maps.Marker({
                                map: mapToUse,
                                position: position,
                                title: location.title,
                                content: '',
                                icon: image,
                                optimized: false,
                                animation: google.maps.Animation.DROP
                        });

                        //Marker click
                        //-----------------------------
                        google.maps.event.addListener(marker, 'click', function () {

                            //Uncomment to go straight to detail page on marker click
                            // window.location.href = location.locationUrl;
                            // return false;

                            if(mapObject.options.viewstyle === "accordion"){
                                self.closeAllLocations();
                            }

                            //Show the bubble
                            viewModel.showInfoWindow(location);
                            //Show/Hide the item in the list
                            location.expanded(!location.expanded());
                        });

                        //Set the marker
                        //-----------------------------u
                        location._mapMarker = marker;
                        viewModel.markers.push(marker);
                    }

                    //Show this location
                    location._mapMarker.setAnimation(google.maps.Animation.DROP);
                    location._mapMarker.setVisible(true);
                });

                //If only one result expand it
                if (self.filteredLocations.peek().length === 1  && mapObject.options.viewstyle != 'listonly') {

                    if(mapObject.options.expandsingleresult !== "false"){
                        //viewModel.filteredLocations()[0].expanded(true);
                        self.showInfoWindow(viewModel.filteredLocations()[0]);
                    }
                }

                //Set zoom
                viewModel.resetMapZoom();
            }
        };


        /*
         * Set the zoom level back to where it should be
         */
        self.resetMapZoom = function () {

            //Clear cluster markers
            if (mapObject.options.clustermarkers == 'true') {
                self.markerClusterer.clearMarkers();
            }

            if (mapObject.options.startlat) {
                //MANUAL LOCATION
                //If centre point doesn't exist yet set it
                if (self.centrePoint === '') {
                    self.centrePoint = new google.maps.LatLng(mapObject.options.startlat, mapObject.options.startlong);
                    self.defaultZoom = parseInt(mapObject.options.defaultzoom,10);
                }

                self.map.panTo(self.centrePoint);
                self.map.setZoom(self.defaultZoom);

            } else {

                //HOME LOCATION
                //If home location is in use make sure that it's in bounds and centred
                if(self.homelocation && self.centrePoint && self.defaultZoom !== ''){

                    self.map.panTo(self.centrePoint);
                    self.defaultZoom = fitToMarkers(self.markers);
                }
                else{

                    //AUTO LOCATION
                    //Bounds object
                    self.bounds = new google.maps.LatLngBounds();

                    ko.utils.arrayForEach(self.filteredLocations.peek(), function(location) {
                        self.bounds.extend(location._mapMarker.position);


                        //If geo is used use it in bounds
                        if(self.userLocation._mapMarker){
                            self.bounds.extend(self.userLocation._mapMarker.position);
                        }

                        if (mapObject.options.clustermarkers == 'true') {
                            self.markerClusterer.addMarker(location._mapMarker);
                        }
                    });

                    //Single location zoom
                    if(self.filteredLocations.peek().length === 1){
                        //TODO:Set single zoom from attribute or use zoom level from click
                        self.map.setZoom(15);
                        var centrepoint = new google.maps.LatLng(self.filteredLocations.peek()[0].latitude, self.filteredLocations.peek()[0].longitude);
                        self.map.panTo(centrepoint);
                    }
                    else{

                        //Fit these bounds to the map
                        self.map.fitBounds(self.bounds);

                        //Move to default position and zoom if no results
                        if (self.bounds.isEmpty()) {

                            //Make sure at least one location was returned
                            if(mapObject.locations.length === 0){
                                self.map.setZoom(14);
                                self.map.panTo( new google.maps.LatLng(0, 0) );
                            }
                            else
                            {
                                self.map.setZoom(self.defaultZoom);
                                self.map.panTo(self.centrePoint);

                            }
                        }
                    }

                }
            }

            updateClusterer();
        };


        //Show clear search button
        self.showClearButton = ko.computed(function(){
            return self.query().length > 0 || self.locationquery().length > 0;
        });

        //Paging
        //======================================

        //Next clicked
        self.nextPage = function(data,element){
            var locations = self.filteredLocations();
            var size = self.pageSize();
            var start = parseInt(self.pageIndex(),10) * parseInt(self.pageSize(),10);

            //Range check
            if((parseInt(start,10) + parseInt(size,10)) < locations.length){
                self.pageIndex(parseInt(self.pageIndex(),10) + 1);
            }
            else{
              return false;
            }
        };

        //Prev clicked
        self.prevPage = function() {
            var size = self.pageSize();
            var start = self.pageIndex() * self.pageSize();

            //Range check
            if ((parseInt(start,10) - parseInt(size,10)) >= 0) {
                self.pageIndex(self.pageIndex() - 1);
            } else {
                return false;
            }
        };

        //Should paging show
        self.pagingVisible = function(){
            return self.filteredLocations().length > self.pageSize();
        };

        //Disable/Enable next button
        self.nextPageButtonCSS = ko.computed(function(){
            return ((self.pageIndex() + 1) * self.pageSize() >= self.filteredLocations().length) ? "disabled" : "";
        });

        //Disable/Enable prev button
        self.prevPageButtonCSS = ko.computed(function(){
            return self.pageIndex() === 0 ? "disabled" : "";
        });

        //Pages count
        self.totalPages = ko.computed(function(){
            return Math.ceil(self.filteredLocations().length / self.pageSize() );
        });

        //Human current page
        self.currentPageNumber = ko.computed(function(){
            return self.pageIndex() + 1;
        });


        //Any locations
        self.anyLocationsAvailable = ko.computed(function(){

            //Needed to stop message showing when no search terms entered
            if( self.hideuntilsearch && !self.anySearchTermsEntered() ){
                return false;
            }

            return self.filteredLocations().length === 0;
        });


        //Paged locations
        //Needs to be separate as map markers are not paged
        self.pagedLocations = ko.computed(function () {
            var locations = self.filteredLocations();

            var start = self.pageIndex() * self.pageSize();

            //Next page
            return locations.slice(start, parseInt(start,10) + parseInt(self.pageSize(),10));
        }, self);

        /*
        * UTILITIES
        =====================================================*/

        //Sort algorithms
        //---------------------------------------------------

        //DISTANCE SORT
        // ascending sort
        function asc_bydistance(a, b){
            if(self.locationquery()){
                return (parseFloat(b.searchDistanceAway()) < parseFloat(a.searchDistanceAway()) ? 1 : -1);
            }
            else{
                return (parseFloat(b.distanceAway()) < parseFloat(a.distanceAway()) ? 1 : -1);
            }

        }

        // decending sort
        function dec_bydistance(a, b){
            if(self.locationquery()){
                return (parseFloat(b.searchDistanceAway()) > parseFloat(a.searchDistanceAway()) ? 1 : -1);
            }
            else{
                return (parseFloat(b.distanceAway()) > parseFloat(a.distanceAway()) ? 1 : -1);
            }
        }

        //TITLE SORT
        // accending sort
        function asc_bytitle(a, b){
            return b.title.toLowerCase() == a.title.toLowerCase() ? 0 : (b.title.toLowerCase() < a.title.toLowerCase() ? -1 : 1);
        }


        // decending sort
        function dec_bytitle(a, b){
            return b.title.toLowerCase() == a.title.toLowerCase() ? 0 : (b.title.toLowerCase() > a.title.toLowerCase() ? -1 : 1);
        }

        function checkCategoriesForSorting(a,b){
            //Neither has a category so the same
            if(a.categories.length === 0 && b.categories.length === 0){
                return 0;
            }

            //A has no category so moves down
            if(a.categories.length === 0 ){
                return -1;
            }

            if(b.categories.length === 0){
                return 1;
            }

            return true;
        }


        function getCategoryIndex(title){

            var foundIndex = null;

            $.each(self.mapCategories,function(index,category){

                if(title.toLowerCase() === category.title.toLowerCase()){
                    foundIndex = index;
                    return true;
                }

            });

            return foundIndex;
        }

        //Category sort
        //Only works with one category
        function asc_bycategorymanual(a, b){

            var checkCategories = checkCategoriesForSorting(a,b);

            if(checkCategories !== true){
                return checkCategories;
            }

            //look up a cat index in categories list
            var aIndex = getCategoryIndex(a.categories[0].title);
            //look up b cat index in categories list
            var bIndex = getCategoryIndex(b.categories[0].title);


            //See which is lower

            //Both have category so sort that way
            return bIndex == aIndex ? 0 : (bIndex > aIndex ? -1 : 1);
        }

        //Only works with one category
        function asc_bycategorytitle(a, b){

            //Initial check to make sure both have categories
            var checkCategories = checkCategoriesForSorting(a,b);

            if(checkCategories !== true){
                return checkCategories;
            }

            //Both have category so sort that way
            return b.categories[0].title.toLowerCase() == a.categories[0].title.toLowerCase() ? 0 : (b.categories[0].title.toLowerCase() > a.categories[0].title.toLowerCase() ? -1 : 1);
        }

        //Get url parameters
        function getParameterByName(name)
        {
            name = name.replace(/[\[]/, "\\\[").replace(/[\]]/, "\\\]");
            var regexS = "[\\?&]" + name + "=([^&#]*)";
            var regex = new RegExp(regexS);
            var results = regex.exec(window.location.search);

            if(results === null){
                return "";
            }
            else{
                return decodeURIComponent(results[1].replace(/\+/g, " "));
            }
        }

        //Get distance between two items
        function calculateDistance(p1lat, p1long, p2lat, p2long) {
            //Convert degrees to radians
            var rad = function(x) { return x * Math.PI / 180; };

            //Haversine formula
            var R;

            if (maplistScriptParamsKo.measurementUnits == 'METRIC') {
                R = 6372.8; // approximation of the earth's radius of the average circumference in km
            } else {
                R = 3961.3; //Radius in miles)
            }


            var dLat = rad(p2lat - p1lat);
            var dLong = rad(p2long - p1long);

            var a = Math.sin(dLat / 2) * Math.sin(dLat / 2) +
                Math.cos(rad(p1lat)) * Math.cos(rad(p2lat)) * Math.sin(dLong / 2) * Math.sin(dLong / 2);
            var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
            var d = R * c;

            return d.toFixed(1);
        }

        /*
         * CONSTRUCTOR FUNCTIONS
         ====================================================*/

        function Location(item) {
            this._mapMarker = '';
            this.address = item.address;
            this.categories = item.categories;
            this.cssClass = item.cssClass;
            this.customCategories = item.customCategories;
            this.description = item.description;
            this.simpledescription = item.simpledescription;
            this.distanceAway = ko.observable();
            this.expanded = ko.observable(false);
            this.friendlyDistance = ko.observable();
            this.imageUrl = item.imageUrl;
            this.latitude = item.latitude;
            this.locationUrl = item.locationUrl;
            this.longitude = item.longitude;
            this.pinColor = 'blue';//GetPinColour;
            this.pinImageUrl = item.pinImageUrl;
            this.searchDistanceAway = ko.observable();
            this.smallImageUrl = item.smallImageUrl;
            this.title = item.title;
        }

        function Category(title, slug, taxonomyName) {
            this.title = title;
            this.slug = slug;
            this.selected = ko.observable(mapObject.options.categoriesticked == 'true');
            this.taxonomyName = taxonomyName || '';
            this.cssClass = ko.computed(function(){
                return this.selected() ? "showing corePrettyStyle btn" : "corePrettyStyle btn";
            },this);

            // Start with a category selected
            // Uncomment this and change slug-name to your slug url
            // if(this.slug == "slug-name"){
            //     this.selected(true);
            //     self.useCategoryFilter(true);
            // }
        }

    }


    //Convert json to object
    var dataFromServer = maplistScriptParamsKo.KOObject;

    //Create an array of maps in case we need to fire anything
    MapListProMaps = [];

    //Needed in case do_shortcode is called more than once
    var mapsOnPageCount = $('.prettyMapList').length;
    var dataObjCount = dataFromServer.length;
    var mapIncAmount = dataObjCount/mapsOnPageCount;

    // Activates knockout.js
    $.each(dataFromServer, function (index, value) {
        //Checks to see if do_shortcode was called more than once
        if((index + 1) % mapIncAmount === 0){
            var newMap = new MapViewModel(value, value.id);
            MapListProMaps.push(newMap);
            ko.applyBindings(newMap, document.getElementById('MapListPro' + value.id));
        }
    });


    //Print directions
    function printDirectionsContent(content) {
        newwin = window.open('', 'printwin', '');
        newwin.document.write('<HTML>\n<HEAD>\n');
        newwin.document.write('<TITLE>Print Page</TITLE>\n');
        newwin.document.write('<script>\n');
        newwin.document.write('function chkstate(){\n');
        newwin.document.write('if(document.readyState=="complete"){\n');
        newwin.document.write('setTimeout("window.close()", 10); \n');
        newwin.document.write('}\n');
        newwin.document.write('else{\n');
        newwin.document.write('setTimeout("chkstate()",2000)\n');
        newwin.document.write('}\n');
        newwin.document.write('}\n');
        newwin.document.write('function print_win(){\n');
        newwin.document.write('window.print();\n');
        newwin.document.write('chkstate();\n');
        newwin.document.write('}\n');
        newwin.document.write('<\/script>\n');
        newwin.document.write('</HEAD>\n');
        newwin.document.write('<BODY onload="print_win()">\n');
        newwin.document.write(content);
        newwin.document.write('</BODY>\n');
        newwin.document.write('</HTML>\n');
        newwin.document.close();
    }

    //Print button for directions
    $('body').on('click','.printDirections',function(){
        var content = $(this).prev().html();
        printDirectionsContent(content);
        return false;
    });

    //Remove loading from all messages
    $('.prettyListItems.loading').removeClass('loading');

    (function($,sr){

      // debouncing function from John Hann
      // http://unscriptable.com/index.php/2009/03/20/debouncing-javascript-methods/
      var debounce = function (func, threshold, execAsap) {
          var timeout;

          return function debounced () {
              var obj = this, args = arguments;
              function delayed () {
                  if (!execAsap)
                      func.apply(obj, args);
                  timeout = null;
              }

              if (timeout)
                  clearTimeout(timeout);
              else if (execAsap)
                  func.apply(obj, args);

              timeout = setTimeout(delayed, threshold || 100);
          };
      };

      // smartresize
      jQuery.fn[sr] = function(fn){  return fn ? this.bind('resize', debounce(fn)) : this.trigger(sr); };

    })(jQuery,'smartresize');


    // usage:
    $(window).smartresize(function(){
      $(document).trigger({type: "resizeMap"});
    });


    // If you need to resize the map because it's in an accordion etc. and it's not showing the correct size
    // do this (change the [0] to the index of the map you need to redraw):
    // google.maps.event.trigger(MapListProMaps[0].map, "resize");

    //To trigger a redraw of all maps do this:
    //$(document).trigger({type: "resizeMap"});

});