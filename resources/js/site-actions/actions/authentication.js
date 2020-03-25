import query from "axios";
import {FETCHING_REGISTER_DATA,
FETCHING_REGISTER_DATA_SUCCESSFUL,
FETCHING_REGISTER_DATA_FAILED,FETCHING_LOGIN_DATA,
FETCHING_LOGIN_DATA_SUCCESSFUL,
FETCHING_LOGIN_DATA_FAILED,LOG_OUT_USER, LOG_OUT_USER_SUCCESSFUL, LOG_OUT_USER_FAILED} from '../index';

export function register({data}) {
  let userData = {
    name: data.name,
    email: data.email,
    password: data.password,
    password_confirmation: data.password_confirmation,
  }, 
    URL = 'api/register';
  return dispatch => {

    dispatch({ type: FETCHING_REGISTER_DATA })

    return  query.post(URL, userData)
      .then(res => {
          return dispatch({ type: FETCHING_REGISTER_DATA_SUCCESSFUL, payload: res.data });                
      })
      .catch(err => {
          return dispatch({ type: FETCHING_REGISTER_DATA_FAILED, payload: err });
      });   
  }
}

export function login({data}) {
    let userData = {
      email: data.email,
      password: data.password,
    },
      URL = 'api/login';
    return dispatch => {
  
      dispatch({ type: FETCHING_LOGIN_DATA })
  
      return  query.post(URL, userData)
        .then(res => {
            return dispatch({ type: FETCHING_LOGIN_DATA_SUCCESSFUL, payload: res.data });                
        })
        .catch(err => {
            return dispatch({ type: FETCHING_LOGIN_DATA_FAILED, payload: err });
        });   
    }
}

export function logout() {
  URL = 'api/logout';
  return dispatch => {
    dispatch({ type: LOG_OUT_USER});
    return query.post(URL)
    .then(res => {
        return dispatch({ type: LOG_OUT_USER_SUCCESSFUL, payload: res.data});
    })
    .catch(err=>{
        return dispatch({ type: LOG_OUT_USER_FAILED, payload: err });
    });
  }
}

export function offline(){
  return;
}