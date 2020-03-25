import query from "axios";
import {FETCHING_LANDING_DATA,
FETCHING_LANDING_DATA_SUCCESSFUL,
FETCHING_LANDING_DATA_FAILED} from '../index';
const prefix = "contact/";

export function contactSupport(data) {
  let formData = {
    name: data.name,
    email: data.email,
    message: data.message,
  };
  return dispatch => {

    dispatch({ type: FETCHING_LANDING_DATA })

    return  query.post(url, userData)
      .then(res => {
          return dispatch({ type: FETCHING_LANDING_DATA_SUCCESSFUL, payload: res.data });                
      })
      .catch(err => {
          return dispatch({ type: FETCHING_LANDING_DATA_FAILED, payload: err });
      });   
  }
}

