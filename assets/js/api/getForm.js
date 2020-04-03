import axios from 'axios';

const newForm = axios.create({
    baseURL: `/api/newForm`,
});

export const getNewForm = () => {
    return newForm({
        method: 'GET',
    });
};