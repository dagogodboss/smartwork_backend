import{
    FETCHING_REGISTER_DATA,
    FETCHING_REGISTER_DATA_SUCCESSFUL,
    FETCHING_REGISTER_DATA_FAILED,
    FETCHING_LOGIN_DATA,
    FETCHING_LOGIN_DATA_SUCCESSFUL,
    FETCHING_LOGIN_DATA_FAILED,
    LOG_OUT_USER, 
    LOG_OUT_USER_SUCCESSFUL, 
    LOG_OUT_USER_FAILED
} from '../../site-actions/index';
let initialState = {
    isFetching : null,
    data : [],
    hasError : false,
    errorMessage: null
}
export default (state = initialState, action)=>{
    switch(action.type) {
        case FETCHING_REGISTER_DATA:
            return Object.assign(state, {
                isFetching: true,
                data: null,
                hasError: false,
                errorMessage: null
            });

        case FETCHING_REGISTER_DATA_SUCCESSFUL:
            return Object.assign(state, {
                isFetching: false,
                data: action.payload,
                hasError: false,
                errorMessage: null
            });

        case FETCHING_REGISTER_DATA_FAILED:
            return Object.assign(state, {
                isFetching: false,
                data: null,
                hasError: true,
                errorMessage: action.payload
            });

        case FETCHING_LOGIN_DATA:
            return Object.assign(state, {
                isFetching: true,
                data: null,
                hasError: false,
                errorMessage: null
            });

        case FETCHING_LOGIN_DATA_SUCCESSFUL:
            return Object.assign(state, {
                isFetching: false,
                data: action.payload,
                hasError: false,
                errorMessage: null
            });

        case FETCHING_LOGIN_DATA_FAILED:
            return Object.assign(state, {
                isFetching: false,
                data: null,
                hasError: true,
                errorMessage: action.payload
            });
        
        case LOG_OUT_USER:
            return Object.assign(state, {
                isFetching: false,
                data: null,
                hasError: true,
                errorMessage: action.payload
            });
        case  LOG_OUT_USER_SUCCESSFUL:
            return Object.assign(state, {
                isFetching: false,
                data: action.payload,
                hasError: true,
                errorMessage: null
            });

        case LOG_OUT_USER_FAILED:
            return Object.assign(state, {
                isFetching: false,
                data: null,
                hasError: true,
                errorMessage: action.payload
            });
        
        default:
            return state;
    }
}