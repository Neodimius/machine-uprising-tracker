# Machine Uprising Tracker

# API Documentation


This API allows you to manage workers and machines, including assigning and unassigning workers to/from machines, retrieving worker and machine information, and accessing the history of worker-machine assignments.

## Table of Contents
- [Introduction](#introduction)
- [Endpoints](#endpoints)
- [Authentication](#authentication)
- [Error Handling](#error-handling)
- [API Endpoints](#api-endpoints)
    - [Get Workers](#get-workers)
    - [Get Machines](#get-machines)
    - [Assign Worker to Machine](#assign-worker-to-machine)
    - [Unassign Worker from Machine](#unassign-worker-from-machine)
    - [Get Worker Info](#get-worker-info)
    - [Get Machine Info](#get-machine-info)
    - [Get Worker History](#get-worker-history)
    - [Get Machine History](#get-machine-history)

## Endpoints

Base URL: `http://api-domain.com/api`

## Authentication

No authentication is required for this API.

## Error Handling

This API returns standard HTTP status codes. In case of an error, you will receive a JSON response with an `error` field providing a description of the error.

## API Endpoints

### Get Workers

**Endpoint:** `/workers`

**Method:** GET

**Description:** Get a list of all workers.

**Example Request:**
`http://api-domain.com/api/workers`

__________
### Get Machines
**Endpoint:** `/machines`

**Method:** GET

**Description:** Get a list of all machines.

**Example Request:**
`http://api-domain.com/api/machines`

__________
### Assign Worker to Machine
**Endpoint:** `/assign-machine`

**Method:** POST

**Description:**  Assign a worker to a machine.

**Request body:**
```json
{
    "worker_id": 1,
    "machine_id": 1
}
```

__________
### Unassign Worker from Machine
**Endpoint:** `/unassign-machine`

**Method:** POST

**Description:**  Unassign a worker from a machine.

**Request body:**
```json
{
    "worker_id": 1,
    "machine_id": 1
}
```

__________
### Get Worker Info
**Endpoint:** `/worker/{id}`

**Method:** GET

**Description:**  Get information about a specific worker.

**Request:**
`http://api-domain.com/api/worker/1
`

__________
### Get Machine Info
**Endpoint:** `/machine/{id}`

**Method:** GET

**Description:**  Get information about a specific machine.

**Request:**
`http://api-domain.com/api/machine/1
`


__________
### Get Worker History
**Endpoint:** `/worker/{id}/history`

**Method:** GET

**Description:**  Get the history of worker assignments to machines (with pagination).

**Request:**
`http://api-domain.com/api/worker/1/history
`

__________
### Get Machine History
**Endpoint:** `/machine/{id}/history`

**Method:** GET

**Description:**  Get the history of worker assignments to a specific machine  (with pagination)..

**Request:**
`http://api-domain.com/api/machine/1/history
`
