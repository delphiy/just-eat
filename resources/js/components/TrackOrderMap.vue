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
            markers: [],
            mapStyle: [],
            carIcon: '/images/car.png',
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
            nightOn: false
        }
    },
    mounted() {
        this.$refs.mapRef.$mapPromise.then(() => {
            this.initSlidingMarker(this.$refs.mapRef.$mapObject)
        });

        this.moveCar()
    },
    methods: {
        changeMapStyle() {
            this.nightOn = !this.nightOn
            this.mapStyle = this.nightOn  ? nightStyle : this.dayStyle
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

                v.carLocation = { lat: toLat, lng: toLng}
                marker.setEasing('linear')
                marker.setPosition(v.carLocation)

                $('img[src*="car.png"]').css('transform', 'rotate('+ bearing +'deg)');

                i += 1;
                v.moveCar()
            }, 1000)
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
