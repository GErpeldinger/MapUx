import { Controller } from 'stimulus';
import mapboxgl from 'mapbox-gl';

export default class extends Controller
{
    connect() {
        fetch()
            const view = JSON.parse(this.element.dataset.view)
            mapboxgl.accessToken = this.element.dataset.key
            const map = new mapboxgl.Map({
                container: this.element, // container ID
                style: this.element.dataset.background, // style URL
                center: view.center, // starting position [lng, lat]
                zoom: view.zoom // starting zoom
            });
    }

}
