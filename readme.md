## Doorkeeper web panel prototype

A rough prototype for the doorkeeper web API.

### API reference

*Note*: all routes have prefix `/api`.

Route                          | Method | Info
-------------------------------|--------|------------------------------
`/resources`                   | `GET`  | A list of the resources
`/resources/{id}`              | `GET`  | The detail of the given resource
`/resources/{id}/reservations` | `GET`  | The future reservations for the given resource
`/resources/{id}/check/{rfid}` | `GET`  | Check if the `rfid` owner has access to the resource (i.e. has an active reservation)
`/reservations`                | `GET`  | A list of the active reservations
