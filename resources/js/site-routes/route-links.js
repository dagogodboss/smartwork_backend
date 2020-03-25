import React from 'react'
import { Switch, Route } from 'react-router-dom'

import LoginPage  from './../pages/login-page/index';
import LandingPage from './../pages/landing-page/index';
import VerificationPage from './../pages/verification-page/index';
import DashboardPage from './../pages/dashboard-page/index';

const Routes = () => (
    <Switch>
      <Route exact path='/' component={LandingPage}/>
      <Route exact path='/login' component={LoginPage}/>
      <Route exact path='/verification' component={VerificationPage}/>
      <Route exact path='/dashboard' component={DashboardPage}/>
      {/* <Route path='/*' component={ErrorPage}/> */}
    </Switch>
);

export default Routes
