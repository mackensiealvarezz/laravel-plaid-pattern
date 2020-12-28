const plaid = window.plaid;


const PLAID_PRODUCTS = 'transactions';

// PLAID_COUNTRY_CODES is a comma-separated list of countries for which users
// will be able to select institutions from.
const PLAID_COUNTRY_CODES = 'US';

const PLAID_REDIRECT_URI = '';


// Create a link token with configs which we can then use to initialize Plaid Link client-side.
// See https://plaid.com/docs/#create-link-token
function create_link_token(user_id) {

    const configs = {
        user: {
            // This should correspond to a unique id for the current user.
            client_user_id: user_id,
        },
        client_name: 'Plaid Quickstart',
        products: PLAID_PRODUCTS,
        country_codes: PLAID_COUNTRY_CODES,
        language: 'en',
    };

    if (PLAID_REDIRECT_URI !== '') {
        configs.redirect_uri = PLAID_REDIRECT_URI;
    }

    window.plaid.createLinkToken(configs, function (error, createTokenResponse) {
        if (error != null) {
            console.log('error: ' + error);
        }
        console.log('response: ' + createTokenResponse);
    });

}
