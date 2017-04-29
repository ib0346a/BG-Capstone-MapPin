//THESE ARE IMAGE RELATED FUNCTIONS
function userImage(){
    // Get the modal
    var modal = document.getElementById('myModal');
                
    // Get the image and insert it inside the modal - use its "alt" text as a caption
    var img = document.getElementById('user_pic');
    var modalImg = document.getElementById("img01");
    
	modal.style.display = "block";
	modalImg.src = img.src;
}
function modalImage(e){
    // Get the modal
    var modal = document.getElementById('myModal2');
                
    // Get the image and insert it inside the modal - use its "alt" text as a caption
   //var img = document.getElementById(e.id);
    var modalImg = document.getElementById("clicked_image");
    
	modal.style.display = "block";
	modalImg.src = e.src;
	
    
}
function modalEdit(){
    var modal = document.getElementById('my_edit_Modal');
    modal.style.display = "block";
}
         
// When the user clicks on <span> (x), close the modal
function closeModal() { 
    // Get the <span> element that closes the modal
    var span = document.getElementsByClassName("close")[0];
    var modal = document.getElementById('myModal');
    
    modal.style.display = "none";
}
function closeModal2(){
    // Get the <span> element that closes the modal
    var span = document.getElementsByClassName("close2")[0];
    var modal = document.getElementById('myModal2');
    modal.style.display = "none";
    
}
function close_edit_Modal(){
    var span = document.getElementsByClassName("edit_close")[0];
    var modal = document.getElementById('my_edit_Modal');
    modal.style.display = "none";
}

//THESE ARE MAP RELATED FUNCTIONS

var map;
var marker_array=[];
var marker;
var infowindow;
var messagewindow;
var random_number;
var marker_name;
var boolean;
var infowindow = null;
var User_Table;
var data_img;
var Title;
var mark_lat_lng;
var click_lat;
var click_lng;
var clicked_marker;
var prev_marker;
var dc_coordinates;
var img_array;
function initMap() {
    var dc = {lat: 38.907192, lng: -77.036871};
    map = new google.maps.Map(document.getElementById('map'), {
        center:dc,
        zoom: 13,
    });//close map

    var ctaLayer = new google.maps.KmlLayer({
          url: 'http://bgcapstone.x10host.com/Pics/DC_City_Limits.kml',
          preserveViewport: true,
          map: map
        });


    intialize_makers();
    //The code below creates a new info window object that retrieves the form element on clicking a marker.
    function intialize_makers(){
        infowindow = new google.maps.InfoWindow();
            // Change this depending on the name of your PHP or XML file
            downloadUrl('thumb_tack_locator.php', function(data) {
                var xml = data.responseXML;
                var markers = xml.documentElement.getElementsByTagName('marker');
                var user=xml.documentElement.getElementsByTagName('user');
                Array.prototype.forEach.call(user, function(userElem) {
                    User_Table = userElem.getAttribute('User_Table');
                });   
                Array.prototype.forEach.call(markers, function(markerElem) {
                    var Marker_Name = markerElem.getAttribute('Marker_Name');
                    var Note = markerElem.getAttribute('Note');
                    var point = new google.maps.LatLng(
                        parseFloat(markerElem.getAttribute('lat')),
                        parseFloat(markerElem.getAttribute('lng')));
        
                    var infowincontent = document.createElement('div');
                    var strong = document.createElement('strong');
                    strong.textContent = "Thumb Tack";
                    infowincontent.appendChild(strong);
                    infowincontent.appendChild(document.createElement('br'));
        
                    var text = document.createElement('text');
                    text.textContent = Note;
                    infowincontent.appendChild(text);
                    var iconBase = 'http://maps.google.com/mapfiles/kml/pal4/';
                    var marker = new google.maps.Marker({
                        map: map,
                        position: point,
                        animation: google.maps.Animation.DROP,
                        icon: iconBase + 'icon46.png'
                    });//close marker creator
                   // find images when marker clicked
                    marker.addListener('click', function() {
                        infowindow.setContent(infowincontent);
                        infowindow.open(map, marker);
                        post();
                        Title=Note;
                        clicked_marker=Marker_Name;
                        function post(){
                            jQuery.ajax({
                                type: "POST",
                                url: "Tac_2_Pic.php",
                                data: ({marker: Marker_Name}),
                                success: function(data){
                                    data_img=data;
                                    //if php does not return error call marker-img function
                                    //to display images
                                    if( !(data.indexOf('Error') >= 0)){
                                        toggleBounce();
                                        function toggleBounce() {
                                            if(prev_marker) {
                                                if (prev_marker.getAnimation() !== null) {             
                                                    prev_marker.setAnimation(null);                               
                                                    marker.setAnimation(google.maps.Animation.BOUNCE);
                                                    prev_marker = marker;
                                                }
                                            }
                                            else {
                                                marker.setAnimation(google.maps.Animation.BOUNCE);
                                                prev_marker = marker;
                                            }
                                                    
                                        }
                                       /* setTimeout(toggleBounce, 4500);*/
                                        mark_lat_lng=point;
                                        marker_imgs();
                                    }//close if statement
                               }//close success function
                             });//close JQuery ajax
                        }//close function post()
                        
                    });//close marker.addListener
                });//close array prototype
            });//close download url
    }//close intialize_makers
        //create new marker when map clicked
        google.maps.event.addListener(ctaLayer, 'click', function(event) {
            var click_lat=event.latLng.lat();
            var click_lng=event.latLng.lng();
            random_number=Math.floor(Math.random()*100000000000)+1;
            marker_name="marker"+random_number.toString();
            create_new_marker();
            function create_new_marker(){
                jQuery.ajax({
                    type: "POST",
                    url: "Create_New_Marker.php",
                    data: ({name: marker_name, lat:click_lat, lng:click_lng}),
                    success: function(marker_data){
                        //if php does not return error call marker-img function
                        //to display images
                        if(marker_data.indexOf('Success') >= 0){
                            reloadMarkers();
                            
                        }//close if statement
                    }//close success function
                });//close JQuery ajax    
            }//close create_new_marker
            
        });//close map click listener
        google.maps.event.addListener(map, "click", function(event) {
            alert("Please select a location in Washington, D.C.");
        });
    }//close initMap()
function reloadMarkers() {
    (function(count) {
        if (count < 2) {
            initMap();
            var caller = arguments.callee;
            window.setTimeout(function() {
                caller(count + 1);
            }, 1000);    
        }
    })(0);
} 


function downloadUrl(url,callback) {
    var request = window.ActiveXObject ?
    new ActiveXObject('Microsoft.XMLHTTP') :
    new XMLHttpRequest;
    
    request.onreadystatechange = function() {
        if (request.readyState == 4) {
            request.onreadystatechange = doNothing;
            callback(request, request.status);
            
        }
        
    };

request.open('GET', url, true);
request.send(null);
}
function doNothing () {
}
function marker_imgs(){
    $("#pictures").find("p").contents().filter(function(){
   		 return this.nodeType === 3;
    }).remove();
    $("#pictures").find("p").prepend(Title);
    //grab #pictures and note
    //alert(data_img);
    //removes current images from pictures display
    $(".user_images_thumbnail").find("img").remove();
    $(".user_images_thumbnail").remove();
    img_array=[];

    img_array=data_img.split(" ");
    var display_imgs;
    if(img_array.length>=1){
        for(var a=0; a<img_array.length;a++){
            var image_name=img_array[a];
            display_imgs="<div class='user_images_thumbnail'><img src='Uploads/"+User_Table+"/"+image_name+"'class='User_Images' id='user_img' alt='Image'onclick='return modalImage(this)'></div>";
            $("#inner_marker_div").prepend(display_imgs);
        }    
    }        
}
function AddImage(){
    $('.edit_modal-content').css('padding-top', '25px');
    $('.edit_modal-content').css('width', '25%');
    
    //make all other blocks disappear
    $('.edit_delete-content').css('display', 'none');
    $('.edit_name-content').css('display', 'none');
    //display add image block
    $('.edit_add-content').css('display', 'block');
}
function EditName(){
    $('.edit_modal-content').css('padding-top', '25px');
    $('.edit_modal-content').css('width', '25%');
    
    //make all other blocks disappear
    $('.edit_delete-content').css('display', 'none');
    $('.edit_add-content').css('display', 'none');
    
    //display edit name block
    $('.edit_name-content').css('display', 'block');
}
function DeleteMarker(){
    $('.edit_modal-content').css('padding-top', '25px');
    $('.edit_modal-content').css('width', '25%');
    
    //make all other blocks disappear
    $('.edit_name-content').css('display', 'none');
    $('.edit_add-content').css('display', 'none');
    
    //display delete account block
    $('.edit_delete-content').css('display', 'block');
}
function DeleteMarkerNow(){
    //get long and lat locations of marker
    var location=mark_lat_lng.toString();
    var location1=location.replace("(","");
    var location2=location1.replace(")","");
    var location3=location2.replace(", "," ");
    var loc_array=[];
    loc_array=location3.split(" ");
    var mark_lat=loc_array[0];
    var mark_lng=loc_array[1];
    alert(mark_lat+" "+mark_lng);
    delete_marker();

    function delete_marker(){
        jQuery.ajax({
            type: "POST",
            url: "Delete_Marker.php",
            data: ({lat:mark_lat, lng:mark_lng, Name:clicked_marker}),
            success: function(marker_deleted){
                alert(marker_deleted);
                //if php does not return error call marker-img function
                //to display images
                if(marker_deleted.indexOf('Success') >= 0){
                    alert("Marker had been deleted");
                   (function(count) {
                        if (count < 2) {
                            var display_imgs="<div class='user_images_thumbnail'style='display: initial;'><img src='Pics/camera.png'class='User_Images' id='user_img' alt='Image'onclick='return modalImage(this)'style='width:auto; height:250px;' ></div>";
                            $("#inner_marker_div").prepend(display_imgs);
                            initMap();
                            var caller = arguments.callee;
                            window.setTimeout(function() {
                                caller(count + 1);
                            }, 1000);    
                        }
                    })(0);
                   
                }//close if statement
            }//close success function
        });//close JQuery ajax 
}
}
function ChangeMarkerNote(form){
    var name=$('#edit_name_input').val();
    change_name();
    function change_name(){
        jQuery.ajax({
            type: "POST",
            url: "Change_Name_Marker.php",
            data: ({Name:clicked_marker, note:name}),
            success: function(marker_re_noted){
                //if php does not return error call marker-img function
                //to display images
                if(marker_re_noted.indexOf('Success') >= 0){
                    alert("Marker had been Re-named");
                    var display_imgs="<div class='user_images_thumbnail'style='display: initial;'><img src='Pics/camera.png'class='User_Images' id='user_img' alt='Image'onclick='return modalImage(this)'style='width:auto; height:250px;' ></div>";
                    $("#inner_marker_div").prepend(display_imgs);
                   (function(count) {
                        if (count < 2) {
                            initMap();
                            var caller = arguments.callee;
                            window.setTimeout(function() {
                                caller(count + 1);
                            }, 1000);    
                        }
                    })(0);
                   
                }//close if statement
            }//close success function
        });//close JQuery ajax    
    }//close change_name
}

function Upload_to_Server(x){
    var img_name=$('#uploadedfile').val();
    /*C:\fakepath\lincoln1.jpg*/
    img_name=img_name.toString();
    img_name=img_name.replace('C:\\fakepath\\','');
    add_img();
    function add_img(){
    jQuery.ajax({
            type: "POST",
            url: "Add_Marker_Img.php",
            data: ({Name:clicked_marker, img:img_name}),
            success: function(marker_img){
                //if php does not return error call marker-img function
                //to display images
                if(marker_img.indexOf('Success') >= 0){
                   (function(count) {
                        if (count < 2) {
                            initMap();
                            var caller = arguments.callee;
                            window.setTimeout(function() {
                                caller(count + 1);
                            }, 1000);    
                        }
                    })(0);
                x= true;
                }//close if statement
            }//close success function
        });//close JQuery ajax    
    }
}

