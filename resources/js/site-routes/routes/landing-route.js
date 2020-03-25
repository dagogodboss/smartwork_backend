import React from 'react';
import { Switch, Route } from 'react-router-dom';


const Routes = () => (
  <Switch>
    <Route path='/' component={LandingPage}/>
  </Switch>
);

export default Routes
