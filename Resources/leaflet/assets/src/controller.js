import { Controller } from 'stimulus';
import * as L from 'leaflet';

export default class extends Controller {
    connect() {
        const view = JSON.parse(this.element.dataset.view)

        const map = L.map(this.element).setView(...view)

        L.tileLayer('https://{s}.tile.openstreetmap.fr/osmfr/{z}/{x}/{y}.png', {
            maxZoom: 20,
            attribution: '&copy; OpenStreetMap France | &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map)
    }
}
