import React from 'react'
import { NavLink } from 'react-router-dom'
import { CContainer, CHeader, CHeaderBrand, CHeaderNav, CNavLink, CNavItem } from '@coreui/react'
import CIcon from '@coreui/icons-react'

import { logo } from 'src/assets/brand/logo'

const AppHeader = () => {
  return (
    <CHeader position="sticky" className="mb-4">
      <CContainer fluid>
        <CHeaderBrand className="mx-auto d-md-none" to="/">
          <CIcon icon={logo} height={48} alt="Logo" />
        </CHeaderBrand>
        <CHeaderNav className="d-none d-md-flex me-auto">
          <CNavItem>
            <CNavLink to="/find-flights" component={NavLink} activeClassName="active">
              Find Flights
            </CNavLink>
          </CNavItem>
        </CHeaderNav>
      </CContainer>
    </CHeader>
  )
}

export default AppHeader
