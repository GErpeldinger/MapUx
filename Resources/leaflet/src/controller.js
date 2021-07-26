import { Controller } from 'stimulus';
import * as L from 'leaflet';

export default class extends Controller
{
    connect() {
        this.redefineIcons()

        const view = JSON.parse(this.element.dataset.view)

        const map = L.map(this.element).setView(...view)

        L.tileLayer('https://{s}.tile.openstreetmap.fr/osmfr/{z}/{x}/{y}.png', {
            maxZoom: 20,
            attribution: '&copy; OpenStreetMap France | &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map)

        L.marker([44.922966, -0.460516]).addTo(map)
    }

    // for some obscure reason, when we use Webpack, we have to redefine the icons
    redefineIcons()
    {
        delete L.Icon.Default.prototype._getIconUrl;
        L.Icon.Default.mergeOptions({
            iconRetinaUrl: require('leaflet/dist/images/marker-icon-2x.png'),
            iconUrl: require('leaflet/dist/images/marker-icon.png'),
            shadowUrl: require('leaflet/dist/images/marker-shadow.png'),
        });
    }
}
