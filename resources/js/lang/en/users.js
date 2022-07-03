export default {
    title: 'User',

    columns: {
        name: 'Name',
        email: 'Email'
    },

    form: {
        name: 'Name',
        email: 'Email',
        password: 'Password',
        password_confirmation: 'Password Confirmation',
        change_password: 'Change Password'
    },

    messages: {
        deleted: 'User deleted',
        not_deleted: 'User not deleted',
        created: 'User created',
        not_created: 'User not created',
        updated: 'User updated',
        not_updated: 'User not updated'
    }
}
