import React, { Component } from 'react';
import axios from "axios";
import TableRow from "./TableRow";
import {ToastContainer} from "react-toastify";


class Table extends Component {
    constructor(props){
        super(props);
        this.state = {
            hotels: [],
        }
    }

    componentDidMount() {
        this.getHotelList();
    }

    /***
     * Get all available hotels from the database
     */
    getHotelList = () => {
        let self = this;
        axios.get('home/hotel-lists').then(
            function (response) {
                console.log(response);
                self.setState({
                    hotels: response.data.hotels
                })
            }
        )
    }
    render() {
        return (
            <div className="container">
                <ToastContainer />
                <div className="row justify-content-center">
                    <table className="table table-hover">
                        <thead>
                        <tr>
                            <th scope="col" width="100px">Name</th>
                            <th scope="col" width="100px">Image</th>
                            <th scope="col" width="100px">City</th>
                            <th scope="col" width="100px">Rating</th>
                            <th scope="col" width="100px">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        {this.state.hotels.map(function(value, index) {
                           return <TableRow key={index} hotel={value} />
                        })}
                        </tbody>
                    </table>
                </div>
            </div>
        )
    }
}

export default Table;
