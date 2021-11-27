import React, { useState, useEffect, useRef } from 'react'
import { CSpinner } from '@coreui/react'
import axios from 'axios'
import {
  CButton,
  CCard,
  CCardBody,
  CCardHeader,
  CCol,
  CForm,
  CFormFeedback,
  CFormLabel,
  CFormSelect,
  CRow,
  CToast,
  CToastHeader,
  CToastBody,
  CToaster,
  CTable,
  CTableHead,
  CTableRow,
  CTableHeaderCell,
  CTableBody,
  CTableDataCell,
} from '@coreui/react'

const FindFlights = () => {
  const [validated, setValidated] = useState(false)
  const [departure, setDeparture] = useState('')
  const [arrival, setArrival] = useState('')
  const [airports, setAirports] = useState(0)
  const [toast, addToast] = useState(0)
  const [spinner, setSpinner] = useState('')
  const [table, setTable] = useState('')
  const toaster = useRef()

  useEffect(() => {
    setSpinner(getSpinner)
    axios.get(process.env.REACT_APP_BACKEND_URL + '/api/airports').then((res) => {
      setAirports(res.data)
      setSpinner('')
    })
  }, [])

  const handleSubmit = (event) => {
    clean()

    if (departure.length === 0 || arrival.length === 0) {
      event.preventDefault()
      event.stopPropagation()
      addToast(getErrorToast('Missing Departure or Arrival airport'))
      return
    }

    if (departure === arrival) {
      event.preventDefault()
      event.stopPropagation()
      addToast(getErrorToast('Departure and Arrival are the same'))
      return
    }

    setValidated(true)
    setSpinner(getSpinner)
    getLowestPriceFlight(departure, arrival)
  }

  const clean = () => {
    setSpinner('')
    setTable('')
  }

  const getLowestPriceFlight = (departure, arrival) => {
    axios
      .get(
        process.env.REACT_APP_BACKEND_URL +
          '/api/flights/lowest-price' +
          '?codeDeparture=' +
          departure +
          '&codeArrival=' +
          arrival,
      )
      .then((res) => {
        setSpinner('')
        if (res.data.error) {
          addToast(getErrorToast(res.data.error))
        } else {
          setTable(getTable(res.data.price, res.data.flights))
        }
      })
  }

  const getSpinner = <CSpinner color="success" variant="grow" />

  const getTable = (price, flights) => {
    return (
      <CTable>
        <CTableHead>
          <CTableRow>
            <CTableHeaderCell scope="col">Departure</CTableHeaderCell>
            <CTableHeaderCell scope="col">Arrival</CTableHeaderCell>
            <CTableHeaderCell scope="col">Price</CTableHeaderCell>
          </CTableRow>
        </CTableHead>
        <CTableBody>{getRowsTable(flights)}</CTableBody>
        <CTableHead>
          <CTableRow>
            <CTableHeaderCell colSpan="2">Total Price:</CTableHeaderCell>
            <CTableDataCell>{price}</CTableDataCell>
          </CTableRow>
        </CTableHead>
      </CTable>
    )
  }

  const getRowsTable = (flights) => {
    return (
      flights.length > 0 &&
      flights.map((flight) => (
        <CTableRow key={flight.id}>
          <CTableDataCell>{flight.departure.name}</CTableDataCell>
          <CTableDataCell>{flight.arrival.name}</CTableDataCell>
          <CTableDataCell>{flight.price}</CTableDataCell>
        </CTableRow>
      ))
    )
  }

  const getErrorToast = (errorMessage) => {
    return (
      <CToast title="Error">
        <CToastHeader close>
          <svg
            className="rounded me-2"
            width="20"
            height="20"
            xmlns="http://www.w3.org/2000/svg"
            preserveAspectRatio="xMidYMid slice"
            focusable="false"
            role="img"
          >
            <rect width="100%" height="100%" fill="#dc483e"></rect>
          </svg>

          <strong className="me-auto">Error</strong>
        </CToastHeader>

        <CToastBody>{errorMessage}</CToastBody>
      </CToast>
    )
  }

  const airportsOptions =
    airports.length > 0 &&
    airports.map((airport) => (
      <option key={airport.code} value={airport.code}>
        {airport.name}
      </option>
    ))

  return (
    <CRow>
      <CCol xs={12}>
        <CToaster ref={toaster} push={toast} placement="bottom-end" />

        <CCard className="mb-4">
          <CCardHeader>
            <strong>Find the flight at lowest price</strong>
          </CCardHeader>
          <CCardBody>
            <CForm
              className="row g-3 needs-validation"
              noValidate
              validated={validated}
              onSubmit={handleSubmit}
            >
              <CCol md={6}>
                <CFormLabel htmlFor="departure-airport">Departure Airport</CFormLabel>
                <CFormSelect
                  id="departure-airport"
                  onChange={(e) => {
                    setDeparture(e.target.value)
                  }}
                >
                  <option value="">Choose a departure airport...</option>
                  {airportsOptions}
                </CFormSelect>
                <CFormFeedback invalid>Please provide a valid departure airport.</CFormFeedback>
              </CCol>
              <CCol md={6}>
                <CFormLabel htmlFor="arrival-airport">Arrival Airport</CFormLabel>
                <CFormSelect
                  id="arrival-airport"
                  onChange={(e) => {
                    setArrival(e.target.value)
                  }}
                >
                  <option value="">Choose a arrival airport...</option>
                  {airportsOptions}
                </CFormSelect>
                <CFormFeedback invalid>Please provide a valid arrival airport.</CFormFeedback>
              </CCol>
              <CCol md={12}>
                <CButton color="primary" type="submit">
                  Find
                </CButton>
              </CCol>
            </CForm>
            <br />
            <CCol md={12}>
              {spinner}
              {table}
            </CCol>
          </CCardBody>
        </CCard>
      </CCol>
    </CRow>
  )
}
export default FindFlights
