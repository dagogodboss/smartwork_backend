import{
    FETCHING_USER_DATA,
    FETCHING_USER_DATA_SUCCESSFUL,
    FETCHING_USER_DATA_FAILED,
    UNVERIFIED_EMAIL,
} from '../../site-actions/index';
let initialState = {
    data : [],
    isAuth:false,
    logout:false,
    hasError : false,
    isFetching : null,
    errorMessage: null,
    unverifiedEmail: false,
}
export default (state = initialState, action)=>{
    switch(action.type) {

        case FETCHING_USER_DATA:
            return Object.assign(state, {
                isFetching: true,
                data: null,
                isAuth:false,
                logout:false,
                hasError: false,
                errorMessage: null
            });

        case FETCHING_USER_DATA_SUCCESSFUL:
            return Object.assign(state, {
                isAuth:true,
                logout:false,
                isFetching: false,
                data: action.payload,
                hasError: false,
                errorMessage: null
            });

        case FETCHING_USER_DATA_FAILED:
            return Object.assign(state, {
                isFetching: false,
                data: null,
                isAuth:false,
                hasError: true,
                errorMessage: action.payload,
                logout:true,
            });
        case UNVERIFIED_EMAIL:
            return Object.assign(state, {
                isFetching: false,
                isAuth:true,
                data: null,
                hasError: true,
                errorMessage: action.payload,
                unverifiedEmail:true,
            });
        default:
            return state;
    }
}