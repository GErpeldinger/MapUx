"use strict";

Object.defineProperty(exports, "__esModule", {
  value: true
});
exports.throwMapEvent = throwMapEvent;

function throwMapEvent(map, mapId) {
  var event = document.createEvent('Event');
  event.initEvent('MapIsLoaded', true, true);
  event.map = map;
  event.mapId = mapId;
  document.dispatchEvent(event);
}