import { app } from './main';
const lifetime = 3000;

export function toastSuccess(message) {
    app.config.globalProperties.$toast.add({
        severity: 'success',
        summary: 'Success',
        detail: message,
        life: lifetime
    });
}

export function toastError(message) {
    console.log(message);
    app.config.globalProperties.$toast.add({
        severity: 'error',
        summary: 'Error',
        detail: message,
        life: lifetime
    });
}

export function toastInfo(message) {
    app.config.globalProperties.$toast.add({
        severity: 'info',
        summary: 'Info',
        detail: message,
        life: lifetime
    });
}

export function toastWarn(message) {
    app.config.globalProperties.$toast.add({
        severity: 'warn',
        summary: 'Warn',
        detail: message,
        life: lifetime
    });
}
