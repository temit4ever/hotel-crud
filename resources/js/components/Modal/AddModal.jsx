import React, { Component } from 'react';
import {toast} from "react-toastify";

class AddModal extends Component {
    constructor(props) {
        super(props);
        this.state = {
            name: '',
            address: '',
            city: '',
            image: '',
            star: '',
            description: '',
            fieldErros: {errorName: '', errorAddress: '', errorCity: '', errorStar: '',errorDesc: '' }
        }
    }

    /***
     * Update name field
     * @param event
     */
    addNameField = (event) => {
        event.preventDefault();
        this.setState({
            name: event.target.value,
        })

    }
    /***
     * Update address field
     * @param event
     */
    addAddressField = (event) => {
        event.preventDefault();
        this.setState({
            address: event.target.value,
        })

    }
    /***
     * Update city field
     * @param event
     */
    addCityField = (event) => {
        event.preventDefault();
        this.setState({
            city: event.target.value,
        })
    }
    /***
     * Update rating field
     * @param event
     */
    addRatingField = (event) => {
        event.preventDefault();
        this.setState({
            star: event.target.value,
        })

    }
    /***
     * Update description field
     * @param event
     */
    addDescField = (event) => {
        event.preventDefault();
        this.setState({
            description: event.target.value,
        })
    }
    /***
     * Update image field
     * @param event
     */
    addImageField = (event) => {
        event.preventDefault();
        this.setState({
            image: event.target.files[0],
        })
    }

    /***
     * Send form data to backend to create new hotel record
     *
     */
    addHotelData = () => {
        const fd = new FormData();
        fd.append('hotelName', this.state.name );
        fd.append('hotelAddress', this.state.address);
        fd.append('hotelCity', this.state.city);
        fd.append('hotelStar', this.state.star);
        fd.append('hotelDescription', this.state.description);
        this.state.image && this.state.image.name ? fd.append('hotelImage',  this.state.image, this.state.image.name)
        : fd.append('hotelImage', this.state.image);
        axios.post("home/add-hotel", fd
            ).then((response) => {
            if (response && response.status === 200) {
                toast.success('New hotel has been added successfully');
                setTimeout(() => {
                    location.reload();
                }, 2000)
            }
        }).catch(({response}) => {

            if ( response && response.status === 422 ) {
                toast.error('Something went wrong!!')
                const error = response.data.errors
                let self = this;
                self.setState({
                    fieldErros: {
                        errorName: (error.hotelName && error.hotelName[0]) ? error.hotelName[0] : "" ,
                        errorAddress: (error.hotelAddress && error.hotelAddress[0]) ? error.hotelAddress[0] : "",
                        errorCity: (error.hotelCity && error.hotelCity[0]) ? error.hotelCity[0] : "",
                        errorStar: (error.hotelStar && error.hotelStar[0]) ? error.hotelStar[0] : "",
                        errorDesc: (error.hotelDescription && error.hotelDescription[0]) ? error.hotelDescription[0] : "",
                        errorImage: (error.hotelImage && error.hotelImage[0]) ? error.hotelImage[0] : "",

                    }
                })
            }
        })
    }

    render() {
        return (
            <div className="modal fade" id="addModal" tabIndex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
                <div className="modal-dialog">
                    <div className="modal-content">
                        <div className="modal-header">
                            <h5 className="modal-title" id="addModalLabel">Add Hotels</h5>
                            <button type="button" className="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div className="modal-body">
                            <form encType="multipart/form-data">
                                <div className="form-group">
                                    <div className="mb-1">
                                        <label className="form-label" aria-label="add-name">Name</label>
                                        <div style={{ color: "red" }}>{this.state.fieldErros.errorName}</div>
                                        <input
                                            className="form-control"
                                            id="add-hotel-name"
                                            onChange={this.addNameField}
                                        />
                                    </div>
                                    <div className="mb-2">
                                        <label className="form-label" aria-label="add-address">Address</label>
                                        <div style={{ color: "red" }}>{this.state.fieldErros.errorAddress}</div>

                                        <input
                                            className="form-control"
                                            id="add-hotel-address"
                                            onChange={this.addAddressField}

                                        />
                                    </div>
                                    <div className="mb-2">
                                        <label className="form-label" aria-label="add-city">City</label>
                                        <div style={{ color: "red" }}>{this.state.fieldErros.errorCity}</div>

                                        <select
                                            className="form-select"
                                            aria-label="Default select city"
                                            id="add-hotel-city"
                                            onChange={this.addCityField}
                                        >
                                            <option selected>Select City</option>
                                            <option value="Amsterdam">Amsterdam</option>
                                            <option value="Barcelona">Barcelona</option>
                                            <option value="Beaulieu-sur-Mer">Beaulieu-sur-Mer</option>
                                            <option value="Cairo">Cairo</option>
                                            <option value="Courchevel">Courchevel</option>
                                            <option value="Grand Cayman">Grand Cayman</option>
                                            <option value="Halkidiki">Halkidiki</option>
                                            <option value="Hong Kong">Hong Kong</option>
                                            <option value="London">London</option>
                                            <option value="Miami">Miami</option>
                                            <option value="Monte Carlo">Monte Carlo</option>
                                            <option value="Narendranagar">Narendranagar</option>
                                            <option value="New York">New York</option>
                                            <option value="Paris">Paris</option>
                                            <option value="San Francisco">San Francisco</option>
                                            <option value="St Tropez">St Tropez</option>
                                            <option value="Tel Aviv">Tel Aviv</option>
                                        </select>
                                    </div>
                                    <div className="mb-2">
                                        <label className="form-label" aria-label="add-desc">Description</label>
                                        <div style={{ color: "red" }}>{this.state.fieldErros.errorDesc ?? ""}</div>

                                        <textarea
                                            rows="5"
                                            className="form-control"
                                            id="add-hotel-desc"
                                            onChange={this.addDescField}

                                        />
                                    </div>
                                    <div className="mb-2">
                                        <label className="form-label" aria-label="add-rating">Rating</label>
                                        <div style={{ color: "red" }}>{this.state.fieldErros.errorStar ?? ""}</div>

                                        <input
                                            className="form-control"
                                            id="add-hotel-rating"
                                            onChange={this.addRatingField}
                                        />
                                    </div>
                                    <div className="mb-2">
                                        <label className="form-label" aria-label="add-image">Update Image</label>
                                        <div style={{ color: "red" }}>{this.state.fieldErros.errorImage}</div>
                                        <input
                                            className="form-control"
                                            type="file"
                                            name="image"
                                            onChange={this.addImageField}
                                        />
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div className="modal-footer">
                            <input
                                className="form-control btn btn-primary"
                                type="submit"
                                id="add-hotel"
                                value="Add"
                                onClick={this.addHotelData}
                            />
                        </div>
                    </div>
                </div>
            </div>
        )
    }
}

export default AddModal;
