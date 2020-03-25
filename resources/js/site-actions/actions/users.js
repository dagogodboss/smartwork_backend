import store from 'store';
import {http, FETCHING_USER_DATA_FAILED, FETCHING_USER_DATA_SUCCESSFUL, FETCHING_USER_DATA, UNVERIFIED_EMAIL } from './../index';
const URL = 'api/user'
export default function usersAction({target, data = null}){
    switch (target) {
        case 'auth':
            return isAuthenticated();               
        case 'getUser':
        return getUser(data); 
        default:
            break;
    }
}

export function getUser(){
    return dispatch => {
        dispatch({ type: FETCHING_USER_DATA})
    return http.post(URL)
        .then(res =>{
            return dispatch({type: FETCHING_USER_DATA_SUCCESSFUL, payload: res.data });
        })
        .catch(err => {
            if(err.response.status  == 403){
                return dispatch({ type: UNVERIFIED_EMAIL, payload: err });            
            }
            return dispatch({ type: FETCHING_USER_DATA_FAILED, payload: err });
        });
    }
}

export function isAuthenticated(){
    return dispatch => {
        dispatch({type: FETCHING_USER_DATA})
        const  token =  store.get('token')
        const data = {token : token }
        if(typeof token !== 'undefined'/*&& token.expires_in > Date.now()*/){
            return dispatch({
                type: FETCHING_USER_DATA_SUCCESSFUL, payload: data 
            })
        }else{
            return dispatch({
                type: FETCHING_USER_DATA_FAILED, payload: data 
            })
        }
    }
    
}