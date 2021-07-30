export function throwMapEvent(map) {
        const event = document.createEvent('Event')
        event.initEvent('MapIsLoaded', true, true)
        event.map = map
        document.dispatchEvent(event)
    }

