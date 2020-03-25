import query from 'axios';
import SiteStore  from '../site-store';
import store from 'store';
const  token =  store.get('token')
import { logout, offline } from './actions/authentication';

export const FETCHING_LANDING_DATA = "FETCHING_LANDING_DATA";
export const FETCHING_LANDING_DATA_SUCCESSFUL = "FETCHING_LANDING_DATA_SUCCESSFUL";
export const FETCHING_LANDING_DATA_FAILED = "FETCHING_LANDING_DATA_FAILED";

export const FETCHING_LOGIN_DATA = "FETCHING_LOGIN_DATA";
export const FETCHING_LOGIN_DATA_SUCCESSFUL = "FETCHING_LOGIN_DATA_SUCCESSFUL";
export const FETCHING_LOGIN_DATA_FAILED = "FETCHING_LOGIN_DATA_FAILED";

export const FETCHING_REGISTER_DATA = "FETCHING_REGISTER_DATA";
export const FETCHING_REGISTER_DATA_SUCCESSFUL = "FETCHING_REGISTER_DATA_SUCCESSFUL";
export const FETCHING_REGISTER_DATA_FAILED = "FETCHING_REGISTER_DATA_FAILED";

export const LOG_OUT_USER = "LOG_OUT_USER";
export const LOG_OUT_USER_SUCCESSFUL = "LOG_OUT_USER_SUCCESSFUL";
export const LOG_OUT_USER_FAILED = "LOG_OUT_USER_FAILED";

export const FETCHING_DASHBOARD_DATA = "FETCHING_DASHBOARD_DATA";
export const FETCHING_DASHBOARD_DATA_SUCCESSFUL = "FETCHING_DASHBOARD_DATA_SUCCESSFUL";
export const FETCHING_DASHBOARD_DATA_FAILED = "FETCHING_DASHBOARD_DATA_FAILED"   

export const FETCHING_USER_DATA = "FETCHING_USER_DATA";
export const FETCHING_USER_DATA_SUCCESSFUL  = "FETCHING_USER_DATA_SUCCESSFUL";
export const UNVERIFIED_EMAIL  = "UNVERIFIED_EMAIL";
export const FETCHING_USER_DATA_FAILED = 'FETCHING_USER_DATA_FAILED';

let access_token;
if(typeof token !== 'undefined'){
    access_token = token.access_token
}else{
    access_token = 'access_token'
}


const AppHttp = query.create({
    baseURL: '',
    headers: {
        'cache-control': 'no-cache',
        'Authorization': 'Bearer '+ access_token,
        'Accept': 'application/json' 
    }
});
AppHttp.interceptors.request.use(
    request =>request,
    () => {
        SiteStore.dispatch(offline())
    }
);
AppHttp.interceptors.response.use(
    response => response,
    (error) => {
        if(error.response.status === 401 ) {
            SiteStore.dispatch(logout())
        }
        return Promise.reject(error);
    }
);
export const http = AppHttp;
