import React, {useState, useRef, useEffect} from 'react';
import axios from "axios";
import {toast} from "react-toastify";
import _ from "lodash";
import Button from '../../../../../vendor/jordenpowleywebdev/laravel-components/resources/js/components/Button';
import FormInput from '../../../../../vendor/jordenpowleywebdev/laravel-components/resources/js/components/forms/FormInput';

const USER_DEFAULTS = {
    first_name:             "",
    last_name:              "",
    email:                  "",
    role:                   "",
    password:               "",
    password_confirmation:  []
}

const CreateEditUser = (props) => {
    const {
        userId       = null,
        onCancel    = () => {},
        onComplete  = () => {},
        onDelete    = () => {},
        parentId    = "",
    } = props;

    const prepareDefaultValues = (defaultRole) => {
        let user = USER_DEFAULTS;

        if (!!defaultRole) {
            user.role = defaultRole;
        }

        return user;
    }

    const [submitting, setSubmitting]   = useState(false);
    const [roles, setRoles]             = useState([]);
    const [user, setUser]               = useState(prepareDefaultValues());
    const [errors, setErrors]           = useState(null);

    useEffect(() => {
        toast.info('TEST');
        // toast.error(<div>{"An error occurred"}</div>);

        load();
    }, [userId]);

    const load = () => {
        axios.get(route('web-api.admin.user.data', {user_id: userId}).toString())
            .then((response) => {
                if (!!response && !!response.data) {
                    if (!!response.data.roles) {
                        setRoles(response.data.roles);
                    }

                    if (!!response.data.user) {
                        setUser(response.data.user);
                    } else {
                        setUser(prepareDefaultValues(!!response.data.default_role ? response.data.default_role : ""));
                    }
                }
            })
            .catch((error) => {
                console.log(error);
                toast.error(<div>{"An error occurred"}</div>);
                setSubmitting(false);
            });
    }

    useEffect(() => {
        if (!!submitting) {
            submit();
        }
    }, [submitting]);

    const reset = () => {
        setUser(USER_DEFAULTS);

        setSubmitting(false);
        setErrors(null);
    }

    const payload = () => {
        return {
            method: !!userId ? 'patch' : 'post',
            url:    !!userId ? route('web-api.admin.user.update', {user: userId}).toString() : route('web-api.admin.user.store').toString(),
            data:   {
                ...user,
            },
        }
    }

    const submit = () => {
        axios(payload())
            .then((response) => {
                reset();
                onComplete(response.data.user_id);
            })
            .catch((error) => {
                if (!!error.response && !!error.response.data && !!error.response.data.errors) {
                    setErrors(error.response.data.errors);

                    // TODO - Fix React Toasts Not Working
                    toast.error(<div>{!!error.response.data.message ? error.response.data.message : "An error occurred"}</div>);
                }

                setSubmitting(false);
            });
    }

    const handleClose = () => {
        if (!submitting) {
            reset();
            onCancel();
        }
    }

    const onChange = (field, value) => {
        const clone = _.cloneDeep(user);

        switch (field) {
            default:
                clone[field] = value;
                break;
        }

        setUser(clone);
    }

    const renderControls = () => {
        return (
            <div className="mt-3 d-flex align-items-center justify-content-between">
                <Button
                    label={"Cancel"}
                    classes={{container: "btn-secondary text-white"}}
                    type={"on_click"}
                    options={{on_click: () => handleClose()}}
                />
                <Button
                    label={"Save User"}
                    classes={{container: "btn-success text-white"}}
                    type={"on_click"}
                    options={{on_click: () => setSubmitting(true)}}
                />
            </div>
        );
    }

    return (
        <React.Fragment>
            <div className="row m-0 p-0">
                <div className="col-12 col-md-6 m-0 p-0 pe-md-2">
                    <FormInput
                        name={"first_name"}
                        label={"First Name"}
                        required={true}
                        type={"text"}
                        value={user.first_name}
                        disabled={submitting}
                        onChange={(value) => onChange('first_name', value)}
                        error={!!errors && !!errors.first_name ? errors.first_name : null}
                    />
                </div>
                <div className="col-12 col-md-6 m-0 p-0 ps-md-2">
                    <FormInput
                        name={"last_name"}
                        label={"Last Name"}
                        required={true}
                        type={"text"}
                        value={user.last_name}
                        disabled={submitting}
                        onChange={(value) => onChange('last_name', value)}
                        error={!!errors && !!errors.last_name ? errors.last_name : null}
                    />
                </div>
            </div>
            <div className="row m-0 p-0">
                <div className="col-12 col-md-6 m-0 p-0 pe-md-2">
                    <FormInput
                        name={"email"}
                        label={"Email"}
                        required={true}
                        type={"email"}
                        value={user.email}
                        disabled={submitting}
                        onChange={(value) => onChange('email', value)}
                        error={!!errors && !!errors.email ? errors.email : null}
                    />
                </div>
                <div className="col-12 col-md-6 m-0 p-0 ps-md-2">
                    <FormInput
                        name={"role"}
                        label={"Role"}
                        required={true}
                        type={"select"}
                        value={user.role}
                        disabled={submitting}
                        onChange={(value) => onChange('role', value)}
                        inputAttributes={{options: roles}}
                        error={!!errors && !!errors.role ? errors.role : null}
                    />
                </div>
            </div>
            {!!userId && (
                <div className="h4 my-3">Optionally Change Password</div>
            )}
            <div className="row m-0 p-0">
                <div className="col-12 col-md-6 m-0 p-0 pe-md-2">
                    <FormInput
                        name={"password"}
                        label={"Password"}
                        required={!userId}
                        type={"password"}
                        value={user.password}
                        disabled={submitting}
                        onChange={(value) => onChange('password', value)}
                        error={!!errors && !!errors.password ? errors.password : null}
                    />
                </div>
                <div className="col-12 col-md-6 m-0 p-0 ps-md-2">
                    <FormInput
                        name={"password_confirmation"}
                        label={"Confirm Password"}
                        required={!userId}
                        type={"password"}
                        value={user.password_confirmation}
                        disabled={submitting}
                        onChange={(value) => onChange('password_confirmation', value)}
                        error={!!errors && !!errors.password_confirmation ? errors.password_confirmation : null}
                    />
                </div>
            </div>
            {renderControls()}
        </React.Fragment>
    );
}

export default CreateEditUser;
