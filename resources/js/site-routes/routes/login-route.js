import React from 'react';
import { Switch, Route } from 'react-router-dom';

const Routes = () => (
  <Switch>
    <Route path='/login' component={LoginPage}/>
  </Switch>
);

export default Routes
