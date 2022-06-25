import React, { useState, useRef, useEffect } from 'react';
import ReactDOM from "react-dom";
import Card from '../../../../vendor/jordenpowleywebdev/laravel-components/resources/js/components/layout/card/Card';
import Header from '../../../../vendor/jordenpowleywebdev/laravel-components/resources/js/components/layout/card/Header';
import Filter from '../../../../vendor/jordenpowleywebdev/laravel-components/resources/js/components/datatable/Filter';
import SearchInput from '../../../../vendor/jordenpowleywebdev/laravel-components/resources/js/components/datatable/SearchInput';
import LoadingIndicator from '../../../../vendor/jordenpowleywebdev/laravel-components/resources/js/components/datatable/LoadingIndicator';
import EmptyTable from '../../../../vendor/jordenpowleywebdev/laravel-components/resources/js/components/datatable/EmptyTable';
import Button from '../../../../vendor/jordenpowleywebdev/laravel-components/resources/js/components/Button';
import debounce from '../../../../vendor/jordenpowleywebdev/laravel-components/resources/js/helpers/Debounce';
import AjaxDynamicDataTable from '@langleyfoxall/react-dynamic-data-table/dist/AjaxDynamicDataTable';

const FILTER_OPTIONS = {
    active: {
        name:   "Active",
        value:  "active"
    },
    deleted: {
        name:   "Deleted",
        value:  "deleted"
    }
}

const UserDataTable = () => {
    const dataTableRef                          = useRef(null);
    const [search, setSearch]                   = useState("");
    const [serverSearch, setServerSearch]       = useState("");
    const [deletedFilter, setDeletedFilter]     = useState(FILTER_OPTIONS.active.value);


    useEffect(() => {
        debounce(() => {
            setServerSearch(search);
        }, 500);
    }, [search]);

    const handleSearch = () => {
        setServerSearch(search);
    }

    const renderRowButton = (item) => {
        return (
            <td>
                <div className={"d-flex justify-content-end align-content-center align-items-center"}>
                    {!!item.can && !!item.can.view && (
                        <a className="text-primary cursor-pointer" href={route('admin.user.show', {user: item.id}).toString()}>
                            View
                        </a>
                    )}
                </div>
            </td>
        )
    }

    return (
        <React.Fragment>
            <Card>
                <Header title={"Users"} />
                <div className={"row m-0 mb-4 p-0 d-flex justify-content-lg-between"}>
                    <div className="col-12 col-md-7 col-lg-8 m-0 mb-4 mb-md-0 p-0 pl-md-2 order-md-2">
                        <div className={"d-flex justify-content-end align-items-center"}>
                            <Filter
                                label={"Filter by Status:"}
                                value={deletedFilter}
                                options={Object.values(FILTER_OPTIONS)}
                                name={"filter_deleted"}
                                onChange={(value) => setDeletedFilter(value)}
                                classes={{container: "me-2"}}
                            />
                            {can('create', 'user') && (
                                <Button
                                    type={"href"}
                                    label={"Create User"}
                                    options={{
                                        href: route('admin.user.create').toString(),
                                        icon: "fas fa-plus-circle"
                                    }}
                                    classes={{container: "btn-secondary"}}
                                />
                            )}
                        </div>
                    </div>
                    <div className="col-12 col-md-5 col-lg-4 m-0 p-0 pr-md-2 order-md-1">
                        <SearchInput
                            value={search}
                            placeholder={"Search..."}
                            onChange={(value) => setSearch(value)}
                            onSearch={() => handleSearch()}
                        />
                    </div>
                </div>
                <div className={"row m-0 p-0"}>
                    <div className={"col-12 m-0 p-0"}>
                        <div className="data-table">
                            <AjaxDynamicDataTable
                                ref={dataTableRef}
                                apiUrl={route('web-api.admin.user.data-table').toString()}
                                loadingComponent={<LoadingIndicator />}
                                noDataComponent={<EmptyTable itemName="users" />}
                                fieldsToExclude={(deletedFilter === FILTER_OPTIONS.deleted.value) ? [
                                    'id',
                                    'can',
                                ] : [
                                    'id',
                                    'can',
                                    'deleted_at',
                                ]}
                                alwaysShowPagination
                                fieldMap={{
                                    created_at: "Created",
                                }}
                                defaultOrderByField={'first_name'}
                                defaultOrderByDirection={'asc'}
                                params={{
                                    searchTerm:     serverSearch,
                                    filterDeleted:  deletedFilter,
                                }}
                                buttons={(row) => renderRowButton(row)}
                            />
                        </div>
                    </div>
                </div>
            </Card>
        </React.Fragment>
    );
}

export default UserDataTable;

const target = document.getElementById('user-data-table');
if (target) {
    ReactDOM.render(<UserDataTable />, target);
}
