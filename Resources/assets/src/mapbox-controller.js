import { Controller } from 'stimulus';
import mapboxgl from 'mapbox-gl';
import * as functions from "./functions.js";


export default class extends Controller {
    connect() {
        const map = this.createMap()

        if (map) {
            this.addMarkersTo(map)
            functions.throwMapEvent(map)
        }
    }

    createMap() {
        const view       = JSON.parse(this.element.dataset.view)
        const background = JSON.parse(this.element.dataset.background)

        mapboxgl.accessToken = this.element.dataset.key

        return new mapboxgl.Map(
            {
                container: this.element,                                // container
                style: background.url,                                  // style URL
                center: [view.center.longitude, view.center.latitude],  // starting position [lng, lat]
                zoom: view.zoom                                         // starting zoom
            }
        );
    }

    addMarkersTo(map) {
        if (this.element.dataset.markers) {
            const markersList = JSON.parse(this.element.dataset.markers)

            markersList.forEach(marker => {
                let mapboxMarker = new mapboxgl.Marker();

                if(marker.icon) {
                    const el = document.createElement('div');
                    el.className = marker.icon.parameters.className
                     mapboxMarker = new mapboxgl.Marker(el);
                }

                mapboxMarker
                    .setLngLat([marker.position.longitude, marker.position.latitude])
                    .addTo(map);
            })
        }
    }
}
