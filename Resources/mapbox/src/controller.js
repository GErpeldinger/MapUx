import { Controller } from 'stimulus';
import mapboxgl from 'mapbox-gl';

export default class extends Controller
{
    connect() {
        fetch()
        const view = JSON.parse(this.element.dataset.view)

        mapboxgl.accessToken = this.element.dataset.key
            const map = new mapboxgl.Map(
                {
                    container: this.element, // container
                    style: this.element.dataset.background, // style URL
                    center: view.center, // starting position [lng, lat]
                    zoom: view.zoom // starting zoom
                }
            );

        if(map) {
            const event = document.createEvent('Event')
            event.initEvent('MapIsLoaded', true, true)
            event.map = map
            document.dispatchEvent(event)
        }
    }
}
