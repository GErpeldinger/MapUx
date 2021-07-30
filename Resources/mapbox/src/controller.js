import { Controller } from 'stimulus';
import mapboxgl from 'mapbox-gl';

export default class extends Controller {
    connect() {
        const map = this.createMap()
        this.addMarkersTo(map)

        if (map) {
            const event = document.createEvent('Event')
            event.initEvent('MapIsLoaded', true, true)
            event.map = map
            document.dispatchEvent(event)
        }
    }

    createMap() {
        const view = JSON.parse(this.element.dataset.view)
        const background = JSON.parse(this.element.dataset.background)

        mapboxgl.accessToken = this.element.dataset.key

        return new mapboxgl.Map(
            {
                container: this.element, // container
                style: background[0],    // style URL
                center: view.center,     // starting position [lng, lat]
                zoom: view.zoom          // starting zoom
            }
        );
    }

    addMarkersTo(map) {
        if (this.element.dataset.markers) {
            const markersList = JSON.parse(this.element.dataset.markers)

            markersList.forEach(marker => {
                const mapboxMarker = new mapboxgl.Marker()
                    .setLngLat([marker.position.longitude, marker.position.latitude])
                    .addTo(map);
            })
        }
    }
}
