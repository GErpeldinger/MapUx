import { Controller } from 'stimulus';
import * as L from 'leaflet';
import * as functions from "./functions.js";

import marker from 'leaflet/dist/images/marker-icon.png';
import marker2x from 'leaflet/dist/images/marker-icon-2x.png';
import markerShadow from 'leaflet/dist/images/marker-shadow.png';

export default class extends Controller {
    connect() {
        this.redefineIcons()
        const map = this.createMap()
        if(map) {
            this.addMarkersTo(map)
            functions.throwMapEvent(map, this.element.id)
        }
    }

    createMap() {
        const view       = JSON.parse(this.element.dataset.view)
        const background = JSON.parse(this.element.dataset.background)

        const map = L.map(this.element).setView([view.center.latitude, view.center.longitude], view.zoom)

        L.tileLayer(background.url, background.options).addTo(map)

        return map
    }

    addMarkersTo(map) {
        if (this.element.dataset.markers) {
            const markersList = JSON.parse(this.element.dataset.markers)

            markersList.forEach(marker => {
                const leafletMarker = L.marker([marker.position.latitude, marker.position.longitude]).addTo(map);

                if(marker.tooltip) {
                    this.addTooltipToMarker(leafletMarker, marker)
                }
            })
        }
    }

    addTooltipToMarker(leafletMarker, marker) {
        leafletMarker.bindTooltip(marker.tooltip.content, marker.tooltip.options)
    }

    /**
     * for some obscure reason, when we use Webpack, we have to redefine the icons :/
     * https://github.com/Leaflet/Leaflet/issues/4968
     */
    redefineIcons() {
        delete L.Icon.Default.prototype._getIconUrl;
        L.Icon.Default.mergeOptions({
            iconRetinaUrl: marker2x,
            iconUrl: marker,
            shadowUrl: markerShadow
        });
    }
}
