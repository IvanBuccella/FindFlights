import React, { Component } from "react";
import axios from "axios";

export default class Form extends Component {
  constructor() {
    super();
    this.state = {
      airports: [],
      departure: "",
      arrival: "",
      error: "",
      pathPrice: -1,
      pathFlights: [],
    };
  }

  componentDidMount() {
    axios
      .get(process.env.REACT_APP_BACKEND_URL + "/api/airports")
      .then((res) => {
        this.setState({ airports: res.data });
      });
  }

  onChange = (e) => {
    this.setState({ [e.target.name]: e.target.value });
  };

  onSubmit = (e) => {
    e.preventDefault();
    const { departure, arrival } = this.state;
    this.setState({ error: "" });
    this.setState({ pathPrice: -1 });
    this.setState({ pathFlights: [] });
    axios
      .get(
        process.env.REACT_APP_BACKEND_URL +
          "/api/flights/lowest-price" +
          "?codeDeparture=" +
          departure +
          "&codeArrival=" +
          arrival
      )
      .then((res) => {
        let path = "";
        if (res.data.error) {
          this.setState({ error: res.data.error });
        } else {
          this.setState({ pathPrice: res.data.price });
          this.setState({ pathFlights: res.data.flights });
        }
        this.setState({ path: path });
      });
  };

  render() {
    const { error, pathPrice, pathFlights } = this.state;

    return (
      <>
        <form onSubmit={this.onSubmit}>
          <select name="departure" onChange={this.onChange}>
            <option value="">Select a Departure Airport</option>
            {this.state.airports.map((airport) => (
              <option value={airport.code}>{airport.name}</option>
            ))}
          </select>
          <select name="arrival" onChange={this.onChange}>
            <option value="">Select an Arrival Airport</option>
            {this.state.airports.map((airport) => (
              <option value={airport.code}>{airport.name}</option>
            ))}
          </select>
          <button type="submit">Find</button>
        </form>
        <p>
          {error.length >= 0 && <span>{error} </span>}
          {pathPrice >= 0 && <span>The min price is &euro;{pathPrice} </span>}
          {pathFlights.length > 0 && (
            <>
              and the path is:
              <br />
            </>
          )}
          {pathFlights.map((flight) => (
            <>
              {flight.departure.code} - {flight.arrival.code}
              <br />
            </>
          ))}
        </p>
      </>
    );
  }
}
