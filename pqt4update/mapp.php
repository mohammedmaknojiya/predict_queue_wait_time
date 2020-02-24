<script>
function arePointsNear(checkPoint, centerPoint, km) {
  var ky = 40000 / 360;
  var kx = Math.cos(Math.PI * centerPoint.lat / 180.0) * ky;
  var dx = Math.abs(centerPoint.lng - checkPoint.lng) * kx;
  var dy = Math.abs(centerPoint.lat - checkPoint.lat) * ky;
  return Math.sqrt(dx * dx + dy * dy) <= km;
}


navigator.geolocation.watchPosition(function(position) {
 var lat = position.coords.latitude;
 var lng = position.coords.longitude;
});
var vasteras = {
  lat: position.coords.latitude,
  lng: position.coords.longitude
};
var stockholm = {
  lat: position.coords.latitude,
  lng: position.coords.longitude
};

var n = arePointsNear(vasteras, stockholm,1 );

alert(n);
</script>