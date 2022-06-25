import React, {useState, useRef, useEffect} from 'react';
import ReactDOM from "react-dom";
import axios from "axios";
import {toast} from "react-toastify";
import _ from "lodash";
import Card from '../../../../../vendor/jordenpowleywebdev/laravel-components/resources/js/components/layout/card/Card';
import Header from '../../../../../vendor/jordenpowleywebdev/laravel-components/resources/js/components/layout/card/Header';
import CreateEditUser from "../../forms/user/CreateEditUser";

const CreateEditUserPage = (props) => {
    const {
        userId = null,
    } = props;

    const handleCancel = () => {
        if (!!userId) {
            window.location.replace(route('admin.user.show', {
                user: userId,
            }).toString());
        } else {
            window.location.replace(route('admin.user.index').toString());
        }
    }

    const handleComplete = (userId) => {
        window.location.replace(route('admin.user.show', {
            user: userId,
        }).toString());
    }

    const handleDelete = () => {
        window.location.replace(route('admin.user.index').toString());
    }

    return (
        <Card>
            <Header title={!!userId ? "Edit User" : "Create User"} />
            <CreateEditUser
                userId={userId}
                onCancel={() => handleCancel()}
                onComplete={(user) => handleComplete(user)}
                onDelete={() => handleDelete()}
                parentId={"create-edit-user-page"}
            />
        </Card>
    )
}

export default CreateEditUserPage;

const target = document.getElementById('create-edit-user-page');
if (target) {
    let {
        userId = null,
    } = target.dataset;

    ReactDOM.render(
        <CreateEditUserPage
            userId={!!userId && userId !== "" ? userId : null}
        />
        , target);
}
