import React from 'react'

const FindFlights = React.lazy(() => import('./views/FindFlights'))

const routes = [
  { path: '/', exact: true, name: 'Home' },
  { path: '/find-flights', exact: true, name: 'FindFlights', component: FindFlights },
]

export default routes
