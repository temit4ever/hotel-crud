import React, { Component } from 'react';
import ViewModal from "../Modal/ViewModal";
import EditModal from "../Modal/EditModal";
import DeleteModal from "../Modal/DeleteModal";
import axios from "axios";

class TableActionButtons extends Component {
    constructor(props) {
        super(props);
        this.state = {
            hotelName: null,
            hotelAddress: null,
            hotelCity: null,
            hotelImage: null,
            hotelDescription: null,
            hotelStar: null,
            latitude: null,
            longitude: null
        }
    }

    /***
     * Get specific hotel from the hotel records based on a specific id
     * @param id
     */
    getHotelDetails = (id) => {
        let self = this;
        axios.get(`home/view-hotel/${id}`).then(
            function (response) {
                self.setState({
                    hotelName: response.data.hotelDetails.hotel_name,
                    hotelAddress: response.data.hotelDetails.address,
                    hotelCity: response.data.hotelDetails.city,
                    hotelImage: response.data.hotelDetails.image,
                    hotelDescription: response.data.hotelDetails.description,
                    hotelStar: response.data.hotelDetails.stars,
                    hotelLong: response.data.hotelDetails.longitude,
                    hotelLat: response.data.hotelDetails.latitude
                })
            }
        )

}
    render() {
        return (
            <div className="btn-group" role="group" aria-label="Basic example">
                <button
                    type="button"
                    className="btn btn-primary"
                    data-bs-toggle="modal"
                    data-bs-target={"#viewModal" + this.props.id}
                    onClick={() => this.getHotelDetails(this.props.id)}
                >
                    View
                </button>
                <ViewModal
                    modalId={this.props.id}
                    hotelInfo={this.state}
                />
                <button
                    type="button"
                    className="btn btn-success"
                    data-bs-toggle="modal"
                    data-bs-target={"#editModal" + this.props.id}
                    onClick={ () => {this.getHotelDetails(this.props.id)}}
                >
                    Edit
                </button>
                <EditModal
                    modalId={ this.props.id }
                />

                <button
                    type="button"
                    className="btn btn-danger"
                    data-bs-toggle="modal"
                    data-bs-target={"#deleteModal" + this.props.id}
                >
                    Delete
                </button>
                <DeleteModal
                    modalId={ this.props.id }
                />
            </div>
        )
    }
}

export default TableActionButtons
