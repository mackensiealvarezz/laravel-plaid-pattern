const plaid = window.plaid;


const PLAID_PRODUCTS = 'transactions';

// PLAID_COUNTRY_CODES is a comma-separated list of countries for which users
// will be able to select institutions from.
const PLAID_COUNTRY_CODES = 'US';

const PLAID_REDIRECT_URI = '';


function create_link_token(user_id) {
    console.log(window.plaid);
    var linkHandler = Plaid.create({
        token: '',
        onLoad: function () {
            // The Link module finished loading.
        },
        onSuccess: function (public_token, metadata) {
            // The onSuccess function is called when the user has successfully
            // authenticated and selected an account to use.
            console.log(public_token);
        },
        onExit: function (err, metadata) {
            // The user exited the Link flow. This is not an Error, so much as a user-directed exit
            if (err != null) {
                console.log(err);
                console.log(metadata);
            }
        },
    });

    console.log(user_id);
}
