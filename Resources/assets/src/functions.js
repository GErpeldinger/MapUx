export function throwMapEvent(map, mapId) {
    const event = document.createEvent('Event')
    event.initEvent('MapIsLoaded', true, true)
    event.map   = map
    event.mapId = mapId
    document.dispatchEvent(event)
}
