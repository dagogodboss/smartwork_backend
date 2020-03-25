import{
    FETCHING_DASHBOARD_DATA,
    FETCHING_DASHBOARD_DATA_SUCCESSFUL,
    FETCHING_DASHBOARD_DATA_FAILED
} from '../../site-actions/index';
let initialState = {
    isFetching : null,
    data : [],
    hasError : false,
    errorMessage: null
}
export default (state = initialState, action)=>{
    switch(action.type) {
        case FETCHING_DASHBOARD_DATA:
            return Object.assign(state, {
                isFetching: true,
                data: null,
                hasError: false,
                errorMessage: null
            });
        case FETCHING_DASHBOARD_DATA_SUCCESSFUL:
            return Object.assign(state, {
                isFetching: false,
                data: action.payload,
                hasError: false,
                errorMessage: null
            });
        case FETCHING_DASHBOARD_DATA_FAILED:
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