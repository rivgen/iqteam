import axios from 'axios';

const newForm = axios.create({
    baseURL: `/api/newForm`,
});

const formVal = axios.create({
    baseURL: `/api/newForm/val`,
});

export const getNewForm = () => {
    return newForm({
        method: 'GET',
    });
};

export const getFormVal = (val) => {
    return formVal({
        method: 'POST',
        data: {
            val
        }
    });
};