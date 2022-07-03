export default {
    title: 'Kullanıcı',

    columns: {
        name: 'İsim',
        email: 'E-posta'
    },

    form: {
        name: 'İsim',
        email: 'E-posta',
        password: 'Şifre',
        password_confirmation: 'Şifre Onayı',
        change_password: 'Şifreyi Değiştir'
    },

    messages: {
        deleted: 'Kullanıcı silindi',
        not_deleted: 'Kullanıcı silinemedi',
        created: 'Kullanıcı oluşturuldu',
        not_created: 'Kullanıcı oluşturulamadı',
        updated: 'Kullanıcı güncellendi',
        not_updated: 'Kullanıcı güncellenemedi'
    }
}
