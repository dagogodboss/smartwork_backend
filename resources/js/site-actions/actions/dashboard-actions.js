import query from "axios";
import {FETCHING_DASHBOARD_DATA,
FETCHING_DASHBOARD_DATA_SUCCESSFUL,
FETCHING_DASHBOARD_DATA_FAILED} from '../index';

export function user({data}) {

    URL = 'api/user';
    return dispatch => {

    dispatch({ type: FETCHING_DASHBOARD_DATA })

    return  query.post(URL, userData)
        .then(res => {
            return dispatch({ type: FETCHING_DASHBOARD_DATA_SUCCESSFUL, payload: res.data });                
        })
        .catch(err => {
            return dispatch({ type: FETCHING_DASHBOARD_DATA_FAILED, payload: err });
        });   
    }
}
  