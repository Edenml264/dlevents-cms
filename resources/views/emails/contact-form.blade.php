<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            background-color: #674019;
            color: #ffffff;
            padding: 20px;
            text-align: center;
        }
        .content {
            padding: 20px;
            background-color: #f9f9f9;
        }
        .footer {
            text-align: center;
            padding: 20px;
            color: #666;
            font-size: 12px;
        }
        .info-item {
            margin-bottom: 10px;
        }
        .label {
            font-weight: bold;
            color: #674019;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Nueva Solicitud de Cotización</h1>
        </div>
        
        <div class="content">
            <p>Se ha recibido una nueva solicitud de cotización con los siguientes detalles:</p>
            
            <div class="info-item">
                <span class="label">Nombre:</span>
                <span>{{ $data['name'] }}</span>
            </div>
            
            <div class="info-item">
                <span class="label">Email:</span>
                <span>{{ $data['email'] }}</span>
            </div>
            
            <div class="info-item">
                <span class="label">Teléfono:</span>
                <span>{{ $data['phone'] }}</span>
            </div>
            
            <div class="info-item">
                <span class="label">Tipo de Evento:</span>
                <span>{{ $data['event_type'] }}</span>
            </div>
            
            <div class="info-item">
                <span class="label">Fecha del Evento:</span>
                <span>{{ \Carbon\Carbon::parse($data['event_date'])->format('d/m/Y') }}</span>
            </div>
            
            <div class="info-item">
                <span class="label">Mensaje:</span>
                <p>{{ $data['message'] }}</p>
            </div>
        </div>
        
        <div class="footer">
            <p>Este email fue enviado desde el formulario de contacto de Diamond Lighting Events.</p>
        </div>
    </div>
</body>
</html>