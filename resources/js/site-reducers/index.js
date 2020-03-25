import { combineReducers } from "redux"
import { loadingBarReducer } from "react-redux-loading-bar"

import { AuthenticationReducer, LandingReducer, UsersReducer } from './reducers/index';

export default combineReducers({
  LandingReducer,
  AuthenticationReducer,
  UsersReducer,
  Loading: loadingBarReducer,
})
