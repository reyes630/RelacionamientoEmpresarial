<div class="data-container">
    <h2 class="form-title">Editar Solicitud</h2>
    <form action="/solicitud/update" method="post">
        <div class="form-group">
            <label for="idSolicitud">ID de la solicitud</label>
            <input readonly value="<?php echo $solicitud->idSolicitud ?>" type="number" id="idSolicitud" name="idSolicitud" class="form-control">
        </div>
        <div class="form-group">
            <label for="descripcion">Descripción</label>
            <input type="text" value="<?php echo $solicitud->DescripcionNecesidad ?>" id="descripcion" name="Descripcion" class="form-control" maxlength="255">
        </div>
        <div class="form-group">
            <label for="fecha">Fecha de la solicitud</label>
            <input value="<?php echo $solicitud->FechaEvento ?>" type="date" id="fecha" name="FechaSolicitud" class="form-control">
        </div>
        <div class="form-group">
            <label for="cliente">Cliente</label>
            <select id="cliente" name="IdCliente" class="form-control">
                <option value="">Seleccione un cliente</option>
                <?php foreach ($clientes as $cliente): ?>
                    <option value="<?php echo $cliente->idCliente; ?>" <?php echo ($solicitud->FKcliente == $cliente->idCliente) ? 'selected' : ''; ?>>
                        <?php echo $cliente->NombreCliente; ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-group">
            <label for="servicio">Servicio</label>
            <select id="servicio" name="IdServicio" class="form-control">
                <option value="">Seleccione un servicio</option>
                <?php foreach ($servicios as $servicio): ?>
                    <option value="<?php echo $servicio->idServicio; ?>" <?php echo ($solicitud->FKtipoServicio == $servicio->idServicio) ? 'selected' : ''; ?>>
                        <?php echo $servicio->Servicio; ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-group">
            <label for="estado">Estado</label>
            <select id="estado" name="IdEstado" class="form-control">
                <option value="">Seleccione un estado</option>
                <?php foreach ($estados as $estado): ?>
                    <option value="<?php echo $estado->idEstado; ?>" <?php echo ($solicitud->FKestado == $estado->idEstado) ? 'selected' : ''; ?>>
                        <?php echo $estado->Estado; ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-group">
            <button type="submit" class="btn-submit">Guardar Cambios</button>
        </div>
    </form>
</div>

<style>
    .data-container {
        max-width: 600px;
        margin: 2rem auto 4rem auto;
        background-color: white;
        border-radius: 10px;
        box-shadow: 0 0 15px rgba(0, 0, 0, 0.08);
        padding: 2rem;
        position: relative; /* Add this */
        z-index: 1; /* Add this to ensure it's above other elements */
        margin-bottom: 6rem; /* Increased bottom margin */
    }

    .form-title {
        color: #2c3e50;
        margin-bottom: 1.5rem;
        font-size: 1.8rem;
        text-align: center;
        font-weight: 600;
    }

    .form-group {
        margin-bottom: 1.2rem;
    }

    .form-group label {
        display: block;
        margin-bottom: 0.5rem;
        color: #2c3e50;
        font-weight: 500;
        font-size: 0.95rem;
    }

    .form-control {
        width: 100%;
        padding: 0.75rem;
        border: 1px solid #e0e0e0;
        border-radius: 8px;
        font-size: 0.95rem;
        transition: all 0.3s ease;
        background-color: #f8f9fa;
    }

    .form-control:focus {
        outline: none;
        border-color: #3498db;
        box-shadow: 0 0 0 3px rgba(52, 152, 219, 0.1);
        background-color: #fff;
    }

    .form-control[readonly] {
        background-color: #e9ecef;
        cursor: not-allowed;
    }

    select.form-control {
        appearance: none;
        background-image: url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3e%3cpolyline points='6 9 12 15 18 9'%3e%3c/polyline%3e%3c/svg%3e");
        background-repeat: no-repeat;
        background-position: right 1rem center;
        background-size: 1em;
        padding-right: 2.5rem;
    }

    .btn-submit {
        width: 100%;
        padding: 0.9rem;
        background-color: #3498db;
        color: white;
        border: none;
        border-radius: 8px;
        font-size: 1rem;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        margin-top: 1rem;
    }

    .btn-submit:hover {
        background-color: #2980b9;
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(52, 152, 219, 0.15);
    }

    @media (max-width: 768px) {
        .data-container {
            margin: 1rem auto 6rem auto; /* Increased bottom margin for mobile */
            padding: 1.5rem;
            width: 90%;
        }
    }
</style>