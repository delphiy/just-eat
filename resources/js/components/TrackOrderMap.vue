<template>
    <div>
        <div class="custom-control custom-switch ml-2 mb-3 mt-1">
            <input type="checkbox" class="custom-control-input" id="customSwitch1" @click="changeMapStyle">
            <label class="custom-control-label" for="customSwitch1">Night</label>
        </div>

        <GmapMap
            ref="mapRef"
            :center="center"
            :zoom="18"
            map-type-id="terrain"
            style="width: 100%;min-height: 600px;"
            :options="mapStyle"
        >
            <GmapMarker
                :position="center"
            />
            <gmap-info-window
                opened=true,
                :position="center"
                :options="{
                    pixelOffset: {
                        width: 0,
                        height: -35
                    }
                }"
            >
            Home
            </gmap-info-window>

            <gmap-info-window
                :opened=isCarWindowOpened
                :position="carLocation"
                :options="{
                    pixelOffset: {
                        width: 0,
                        height: -35
                    }
                }"
            >
                {{ carInfoWindow }}
            </gmap-info-window>

            <gmap-polyline v-if="path.length > 0" :path="path" ref="polyline" :options="polylineOptions"></gmap-polyline>

        </GmapMap>
    </div>
</template>

<script>
import data from './json/data.json'
import nightStyle from './json/nightStyle.json'
let marker;
let i = 0

export default {
    data() {
        return {
            path: [
                { lat: 53.462658772581754, lng: -2.250049734216737 },
                { lat: 53.46258212400539, lng: -2.249996090036439 },
                { lat: 53.462505475290655, lng: -2.249953174692201 },
                { lat: 53.46242882643754, lng: -2.249910259347963 },
                { lat: 53.462352177446014, lng: -2.249867344003724 },
                { lat: 53.46226914088241, lng: -2.249813699823426 },
                { lat: 53.462218041377895, lng: -2.249792242151307 },
                { lat: 53.46216055436182, lng: -2.249760055643129 },
                { lat: 53.46209667980822, lng: -2.249706411462831 },
                { lat: 53.46204558009619, lng: -2.249674224954652  },
                { lat: 53.46200725527173, lng: -2.249642038446473 },
                { lat: 53.46196893041272, lng: -2.249609851938295 },
                { lat: 53.46198856705823, lng: -2.249551644815013 },
                { lat: 53.461999745140524, lng: -2.249508729470775 },
                { lat: 53.46200852791738, lng: -2.249444356454418 },
                { lat: 53.462018907560434, lng: -2.249409487737224 },
                { lat: 53.46203008563473, lng: -2.249366572392986 },
                { lat: 53.46204286057318, lng: -2.249310246003673 },
                { lat: 53.46205563550777, lng: -2.249279400600002 },
                { lat: 53.46206681357241, lng: -2.249228438628719 },
                { lat: 53.462073999469524, lng: -2.249194911016033 }
            ],
            polylineOptions: {
                strokeColor: 'black'
            },
            markers: [],
            mapStyle: [],
            carIcon: '/images/car.png',
            whiteCarIcon: '/images/car-white.png',
            dayStyle: {
                styles: [
                    []
                ]
            },
            center: {
                lat: 53.4620,
                lng: -2.2493,
            },
            carLocation: {
                lat: 53.46260769183019,
                lng: -2.250012352001368,
            },
            nightOn: false,
            isCarWindowOpened: false,
            carInfoWindow: 'Driver'
        }
    },
    mounted() {
        this.$refs.mapRef.$mapPromise.then(() => {
            this.initSlidingMarker(this.$refs.mapRef.$mapObject)
        });

        this.moveCar()
        this.animatePolyline()
    },
    methods: {
        changeMapStyle() {
            this.nightOn = !this.nightOn
            this.mapStyle = this.nightOn  ? nightStyle : this.dayStyle
            marker.setIcon(this.nightOn ? this.whiteCarIcon: this.carIcon)
        },
        initSlidingMarker(map) {
            const SlidingMarker = require('marker-animate-unobtrusive')
            SlidingMarker.initializeGlobally()
            marker = new SlidingMarker({
                position: this.carLocation,
                map: map,
                title: 'I am sliding marker',
                icon: this.carIcon
            })
        },
        moveCar() {
            let v = this
            setTimeout( function() {
                const toLat = data.features[i].geometry.coordinates[1]
                const toLng= data.features[i].geometry.coordinates[0]
                const bearing = v.$bearing(v.carLocation.lat, v.carLocation.lng, toLat, toLng)
                let distance = v.$distance(v.carLocation.lat, v.carLocation.lng, toLat, toLng)
                v.carLocation = { lat: toLat, lng: toLng}
                marker.setEasing('linear')
                marker.setPosition(v.carLocation)

                $('img[src*="car.png"]').css('transform', 'rotate('+ bearing +'deg)');
                $('img[src*="car-white.png"]').css('transform', 'rotate('+ bearing +'deg)');

                if(distance <= 3) {
                    v.isCarWindowOpened = true
                    v.carInfoWindow = "Drive Here"
                }

                i += 1;
                v.moveCar()
            }, 1000)
        },
        animatePolyline() {
            let isPolylineBlack = true
            let currentOptions;
            let v = this

            function togglePolyline() {
                if(isPolylineBlack) {
                    currentOptions = { strokeColor: 'gray' }
                    isPolylineBlack = false
                } else {
                    currentOptions = { strokeColor: 'black' }
                    isPolylineBlack = true
                }

                v.polylineOptions = currentOptions
            }

            setInterval(togglePolyline, 1000)
        }
    },

}
</script>

<style>
.custom-control-label {
    position: relative;
    margin-bottom: 0;
    vertical-align: top;
}

.custom-control-input {
    position: absolute;
    z-index: -1;
    opacity: 0;
}

.custom-switch {
    padding-left: 2.25rem;
}

.custom-control {
    position: relative;
    display: block;
    min-height: 1.5rem;
    padding-left: 1.5rem;
}

.custom-control-input:checked ~ .custom-control-label::before {
    color: #fff;
    border-color: #0b55c1;
    background-color: #0b55c1;
}

.custom-switch .custom-control-label::before {
    left: -2.25rem;
    width: 1.75rem;
    pointer-events: all;
    border-radius: .5rem;
}

.custom-control-label::before, .custom-file-label, .custom-select {
    transition: background-color .15s ease-in-out, border-color .15s ease-in-out, box-shadow .15s ease-in-out;
}

.custom-control-label::before {
    position: absolute;
    top: .25rem;
    left: -1.5rem;
    display: block;
    width: 1rem;
    height: 1rem;
    pointer-events: none;
    content: "";
    background-color: #fff;
    border: #adb5bd solid 1px;
}

.custom-switch .custom-control-input:checked ~ .custom-control-label::after {
    background-color: #fff;
    -webkit-transform: translateX(.75rem);
    transform: translateX(.75rem);
}

.custom-switch .custom-control-label::after {
    top: calc(.25rem + 2px);
    left: calc(-2.25rem + 2px);
    width: calc(1rem - 4px);
    height: calc(1rem - 4px);
    background-color: #adb5bd;
    border-radius: .5rem;
    transition: background-color .15s ease-in-out, border-color .15s ease-in-out, box-shadow .15s ease-in-out, -webkit-transform .15s ease-in-out;
    transition: transform .15s ease-in-out, background-color .15s ease-in-out, border-color .15s ease-in-out, box-shadow .15s ease-in-out;
    transition: transform .15s ease-in-out, background-color .15s ease-in-out, border-color .15s ease-in-out, box-shadow .15s ease-in-out, -webkit-transform .15s ease-in-out;
}

.custom-control-label::after {
    position: absolute;
    top: .25rem;
    left: -1.5rem;
    display: block;
    width: 1rem;
    height: 1rem;
    content: "";
    background: no-repeat 50%/50% 50%;
}
</style>
