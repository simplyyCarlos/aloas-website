import {app} from './main'; 

const lifetime = 3000;

export function showSucess(message){
    app.config.globalProperties.$toast.add({
        severity: 'success',
        summary: 'Sucess',
        detail: message,
        life: lifetime
    });
}

export function showError(message){
    app.config.globalProperties.$toast.add({
        severity: 'error',
        summary: 'Error',
        detail: message,
        life: lifetime
    });
}

export function showWarn(message){
    app.config.globalProperties.$toast.add({
        severity: 'warn',
        summary: 'Warn',
        detail: message,
        life: lifetime
    });
}

export function showInfo(message){
    app.config.globalProperties.$toast.add({
        severity: 'info',
        summary: 'Info',
        detail: message,
        life: lifetime
    });
}
