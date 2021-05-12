export default {
    install(Vue, options) {
        Vue.prototype.$italicHTML = function (text) {
            return '<i>' + text + '</i>';
        }

        Vue.prototype.$toRadians = function (degrees) {
            return degrees * Math.PI / 180;
        }

        Vue.prototype.$toDegrees = function (radians) {
            return radians * 180 / Math.PI;
        }

        Vue.prototype.$bearing = function (startLat, startLng, destLat, destLng) {
            startLat = this.$toRadians(startLat);
            startLng = this.$toRadians(startLng);
            destLat = this.$toRadians(destLat);
            destLng = this.$toRadians(destLng);

            let y = Math.sin(destLng - startLng) * Math.cos(destLat);
            let x = Math.cos(startLat) * Math.sin(destLat) -
                Math.sin(startLat) * Math.cos(destLat) * Math.cos(destLng - startLng);
            let brng = Math.atan2(y, x);
            brng = this.$toDegrees(brng);
            return (brng + 360) % 360;
        }

        Vue.prototype.$distance = function (lat1, lng1, lat2, lng2) {
            return google.maps.geometry.spherical.computeDistanceBetween(new google.maps.LatLng(lat1, lng1),
                new google.maps.LatLng(lat2, lng2));
        }
    }
}
