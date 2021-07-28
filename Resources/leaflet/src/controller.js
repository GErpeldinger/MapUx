import { Controller } from 'stimulus';
import * as L from 'leaflet';

import marker from 'leaflet/dist/images/marker-icon.png';
import marker2x from 'leaflet/dist/images/marker-icon-2x.png';
import markerShadow from 'leaflet/dist/images/marker-shadow.png';

export default class extends Controller
{
    connect() {
        this.redefineIcons()

        const view = JSON.parse(this.element.dataset.view)
        const background = JSON.parse(this.element.dataset.background)

        const map = L.map(this.element).setView(...view)

        L.tileLayer(...background).addTo(map)
    }

    /**
     * for some obscure reason, when we use Webpack, we have to redefine the icons :/
     * https://github.com/Leaflet/Leaflet/issues/4968
     */
    redefineIcons()
    {
        delete L.Icon.Default.prototype._getIconUrl;
        L.Icon.Default.mergeOptions({
            iconRetinaUrl: marker2x,
            iconUrl: marker,
            shadowUrl: markerShadow
        });
    }
}