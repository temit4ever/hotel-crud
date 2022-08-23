import React, { useEffect, useState} from 'react';
import axios from "axios";
import { toast } from "react-toastify";
import 'react-toastify/dist/ReactToastify.css';

/***
 * Functionality to edit selected items from hotel lists
 *
 * @param props
 * @returns {JSX.Element}
 * @constructor
 */
export default function EditHotelDetails(props) {
    const [hotel_name, setName] = useState("")
    const [address, setAddress] = useState("")
    const [city, setCity] = useState("")
    const [stars, setStar] = useState("")
    const [description, setDescription] = useState("")
    const [image, setImage] = useState(null)
    const [hotelName, setNameErrors] = useState("")
    const [hotelAddress, setAddressErrors] = useState("")
    const [hotelCity, setCityErrors] = useState("")
    const [hotelStar, setStarErrors] = useState("")
    const [hotelImage, setImageErrors] = useState("")
    const [hotelDescription, setDescriptionErrors] = useState("")


    useEffect(() => {
        fetchHotelDetails()
    },[])

    /***
     * Fetch hotel details data
     *
     * @returns {Promise<void>}
     */
    const fetchHotelDetails = async () => {
         axios.get(`home/view-hotel/${props.modalId}`).then( function(response) {
            const {hotel_name, address, city, stars, description} = response.data.hotelDetails
            setName(hotel_name)
            setAddress(address)
            setCity(city)
            setStar(stars)
            setDescription(description)
        })
    }

    /**
     * On change event to the image upload
     *
     * @param event
     */
    const changeHandler = (event) => {
        event.preventDefault()
        setImage(event.target.files[0]);
    }

    const onChangeCityHandler = (event) => {
        event.preventDefault();
        event.target.value !== 'Select City' ? setCity(event.target.value) : setCity("");
    }

    /***
     * Axios call to update the selected hotel
     *
     * @param event
     * @returns {Promise<void>}
     */
    const updateHotelInfo = async (event) => {
        event.preventDefault();
        const formData = new FormData()
        formData.append('_method', 'PATCH');
        formData.append('hotelName', hotel_name);
        formData.append('hotelAddress', address);
        formData.append('hotelCity', city);
        formData.append('hotelStar', stars);
        formData.append('hotelDescription', description);
        if (image !== null) {
            formData.append('hotelImage', image)
        }

        axios.post(`home/edit-hotel/${props.modalId}`, formData)
            .then((response) => {
                if ( response && response.status === 200) {
                    toast.success('Hotel details updated successfully')
                    setTimeout(() => {
                        location.reload();
                    }, 1500)
                }
            }).catch(({response}) => {
                /* Use the error message from backend to create front end validation */
                if (response && response.status === 422) {
                    toast.error('Something went wrong')
                    const error = response.data.errors
                    const {hotelName, hotelAddress, hotelCity, hotelStar, hotelImage, hotelDescription} = error;
                    setNameErrors(hotelName)
                    setAddressErrors(hotelAddress)
                    setCityErrors(hotelCity)
                    setStarErrors(hotelStar)
                    setImageErrors(hotelImage)
                    setDescriptionErrors(hotelDescription)
                }
            })
    }

    return (
        <div className="modal fade" id={"editModal" + props.modalId} tabIndex="-1" aria-labelledby="editModalLabel"
             aria-hidden="true">
            <div className="modal-dialog">
                <div className="modal-content">
                    <div className="modal-header">
                        <h5 className="modal-title" id="editModalLabel">Edit Hotel</h5>
                        <button type="button" className="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div className="modal-body">
                        <form encType="multipart/form-data" onSubmit={updateHotelInfo}>
                            <div className="form-group">
                                <div className="mb-1">
                                    <label className="form-label" aria-label="edit-name">Name</label>
                                    <div style={{ color: "red" }}>{hotelName}</div>
                                    <input
                                        name="name"
                                        className="form-control"
                                        id="edit-hotel-name"
                                        value={hotel_name ?? ""}
                                        onChange={(event) => {
                                            setName(event.target.value)
                                        }}
                                    />
                                </div>
                                <div className="mb-2">
                                    <label className="form-label" aria-label="edit-address">Address</label>
                                    <div style={{ color: "red" }}>{hotelAddress}</div>
                                    <input
                                        name="address"
                                        className="form-control"
                                        id="edit-hotel-address"
                                        value={address ?? ""}
                                        onChange={(event) => {
                                            setAddress(event.target.value)
                                        }}
                                    />
                                </div>
                                <div className="mb-2">
                                    <label className="form-label" aria-label="edit-city">City</label>
                                    <div style={{ color: "red" }}>{city === '' ? hotelCity : ''}</div>

                                    <select
                                        name="city"
                                        className="form-select"
                                        aria-label="Default select city"
                                        id="edit-hotel-city"
                                        value={city ?? " "}
                                        onChange={onChangeCityHandler}
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
                                    <label className="form-label" aria-label="edit-desc">Description</label>
                                    <div style={{ color: "red" }}>{hotelDescription}</div>

                                    <textarea
                                        name="description"
                                        rows="5"
                                        className="form-control"
                                        id="edit-hotel-desc"
                                        value={description ?? ""}
                                        onChange={(event) => {
                                            setDescription(event.target.value)
                                        }}
                                    />
                                </div>
                                <div className="mb-2">
                                    <label className="form-label" aria-label="edit-rating">Rating</label>
                                    <div style={{ color: "red" }}>{hotelStar}</div>

                                    <input
                                        name="rate"
                                        className="form-control"
                                        id="edit-hotel-rating"
                                        value={stars ?? ""}
                                        onChange={(event) => {
                                            setStar(event.target.value)
                                        }}
                                    />
                                </div>
                                <div className="mb-2">
                                    <label className="form-label" aria-label="edit-image">Update Image</label>
                                    <div style={{ color: "red" }}>{hotelImage}</div>

                                    <input
                                        className="form-control"
                                        type="file"
                                        name="image"
                                        onChange={changeHandler}
                                    />
                                </div>
                                <div className="modal-footer">
                                    <input
                                        className="form-control btn btn-info"
                                        type="submit"
                                        id="hotel-edit"
                                        value="Edit"
                                    />
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    )
}


