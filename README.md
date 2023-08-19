# tseg-exercise
the student energy group exercise
terms:
    * Meter – an installed piece of equipment to measure energy consumption that 
        sits between a house and the energy distribution network.
    * Meter Serial Number – a unique identifier for an installed meter
    * Meter Reading – a measurement of energy consumption through a meter
    * kWh – a kilowatt-hour
    * MPAN – the Meter Point Administration Number is a unique identifier for an 
        electricity meter
    * MPRN – the Meter Point Reference Number is a unique identifier for a 
        gas meter
    * MPXN – an unofficial way TSEG refers to a meter identifier when referring 
        to meters in general. An MPXN could be an MPAN or MPRN.
    * EAC – Estimated Annual Consumption, the amount of kWh we expect a meter 
        to use each year.
Params:

    DB tables:

        +Meters:
            -id auto increment
            -identifier (mpxn) unique
            -installation date
            -gas or electricity
            -estimated annual consumption (2000 - 8000)

        +Meter readings
            -id auto increment
            -mpxn foreign key
            -reading value
            -reading date


    Tasks:
        Meters {
            -Create form whee user can add new meter
            -list view of the meters
            -meter details view
        }

        Meter Readings {
            -form to add meter reading in the meter details view
            -recorded reading show in the details page
            -validation (reading can be just Integer)
        }

        Optional tasks:

        +A {
            - if reading not recorded at the time, calculate the usage used by 
                estiamted annual consumption
            - Process should return with estimated date if arguments provided:
                args: 
                    * previous reading date and value
                    * estimated annual cons.
                    * date for reading
            - form have date input, submit button
            - check if the recorded reading is in 25% range of the expected
        }
        
        +B {
            -form with file upload
                header: reading|date|MPXN
            -data validation, ignored lines response to user if possible
            -save a copy of the file in the server 
            - job handle data upload and unlink the file
        }