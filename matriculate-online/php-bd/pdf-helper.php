<?php
/**
 * Helper para generación de reportes PDF
 * Usa HTML + CSS para crear PDFs sin dependencias externas
 */

class PDFHelper {
    
    /**
     * Genera un PDF desde HTML usando extensión nativa de PHP
     * Nota: Requiere extensión php_pdflib o usa mpdf/tcpdf como alternativa
     * Por simplicidad, usaremos generación HTML que se puede convertir a PDF
     */
    
    /**
     * Genera un comprobante de pago en formato HTML/PDF
     * 
     * @param array $pago Datos del pago
     * @param array $usuario Datos del usuario
     * @return string HTML del comprobante
     */
    public static function generarComprobantePago($pago, $usuario) {
        $fecha = date('d/m/Y H:i:s');
        $fechaPago = date('d/m/Y', strtotime($pago['fecha_pago']));
        
        ob_start();
        ?>
        <!DOCTYPE html>
        <html lang="es">
        <head>
            <meta charset="UTF-8">
            <title>Comprobante de Pago - <?php echo $pago['id']; ?></title>
            <style>
                @page {
                    margin: 2cm;
                }
                body {
                    font-family: 'Arial', sans-serif;
                    font-size: 12px;
                    line-height: 1.6;
                    color: #333;
                }
                .header {
                    text-align: center;
                    margin-bottom: 30px;
                    border-bottom: 3px solid #1D327B;
                    padding-bottom: 20px;
                }
                .logo {
                    max-width: 150px;
                    margin-bottom: 10px;
                }
                .header h1 {
                    color: #1D327B;
                    margin: 10px 0;
                    font-size: 24px;
                }
                .header p {
                    margin: 5px 0;
                    color: #666;
                }
                .comprobante-info {
                    background: #f8f9fa;
                    padding: 15px;
                    border-radius: 8px;
                    margin-bottom: 20px;
                }
                .comprobante-info table {
                    width: 100%;
                }
                .comprobante-info td {
                    padding: 5px;
                }
                .comprobante-info td:first-child {
                    font-weight: bold;
                    width: 40%;
                }
                .section {
                    margin-bottom: 25px;
                }
                .section-title {
                    background: #1D327B;
                    color: white;
                    padding: 10px 15px;
                    margin-bottom: 15px;
                    border-radius: 5px;
                    font-size: 14px;
                    font-weight: bold;
                }
                table {
                    width: 100%;
                    border-collapse: collapse;
                }
                th {
                    background: #e9ecef;
                    padding: 10px;
                    text-align: left;
                    font-weight: bold;
                    border-bottom: 2px solid #1D327B;
                }
                td {
                    padding: 10px;
                    border-bottom: 1px solid #dee2e6;
                }
                .total-row {
                    background: #f8f9fa;
                    font-weight: bold;
                    font-size: 14px;
                }
                .footer {
                    margin-top: 40px;
                    text-align: center;
                    font-size: 10px;
                    color: #666;
                    border-top: 1px solid #dee2e6;
                    padding-top: 20px;
                }
                .stamp-box {
                    margin-top: 50px;
                    display: flex;
                    justify-content: space-between;
                }
                .signature-line {
                    width: 45%;
                    text-align: center;
                }
                .signature-line hr {
                    border: none;
                    border-top: 1px solid #333;
                    margin: 50px 0 10px 0;
                }
                .watermark {
                    position: fixed;
                    top: 50%;
                    left: 50%;
                    transform: translate(-50%, -50%) rotate(-45deg);
                    font-size: 80px;
                    color: rgba(29, 50, 123, 0.05);
                    z-index: -1;
                    font-weight: bold;
                }
                .badge-paid {
                    display: inline-block;
                    background: #198754;
                    color: white;
                    padding: 5px 15px;
                    border-radius: 20px;
                    font-weight: bold;
                    font-size: 11px;
                }
                .badge-pending {
                    display: inline-block;
                    background: #ffc107;
                    color: #000;
                    padding: 5px 15px;
                    border-radius: 20px;
                    font-weight: bold;
                    font-size: 11px;
                }
                @media print {
                    body { margin: 0; }
                    .no-print { display: none; }
                }
            </style>
        </head>
        <body>
            <div class="watermark">BOLIVARIANO</div>
            
            <div class="header">
                <h1>INSTITUTO SUPERIOR UNIVERSITARIO BOLIVARIANO</h1>
                <p>José A. Eguiguren entre Bolívar y Sucre - Loja, Ecuador</p>
                <p>Teléfono: +593-72575245 | Email: info@tbolivariano.edu.ec</p>
                <p style="margin-top: 15px; font-size: 16px; font-weight: bold; color: #1D327B;">
                    COMPROBANTE DE PAGO
                </p>
            </div>

            <div class="comprobante-info">
                <table>
                    <tr>
                        <td><strong>N° Comprobante:</strong></td>
                        <td><?php echo str_pad($pago['id'], 8, '0', STR_PAD_LEFT); ?></td>
                        <td><strong>Fecha de Emisión:</strong></td>
                        <td><?php echo $fecha; ?></td>
                    </tr>
                    <tr>
                        <td><strong>Estudiante:</strong></td>
                        <td colspan="3"><?php echo htmlspecialchars($usuario['nombres'] . ' ' . $usuario['apellidos']); ?></td>
                    </tr>
                    <tr>
                        <td><strong>Identificación:</strong></td>
                        <td><?php echo htmlspecialchars($usuario['identificacion']); ?></td>
                        <td><strong>Usuario:</strong></td>
                        <td><?php echo htmlspecialchars($usuario['usuario']); ?></td>
                    </tr>
                </table>
            </div>

            <div class="section">
                <div class="section-title">DETALLE DEL PAGO</div>
                <table>
                    <thead>
                        <tr>
                            <th>Concepto</th>
                            <th>Fecha de Pago</th>
                            <th>Método</th>
                            <th>Estado</th>
                            <th style="text-align: right;">Monto</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><?php echo htmlspecialchars($pago['concepto'] ?? 'Pago de Matrícula'); ?></td>
                            <td><?php echo $fechaPago; ?></td>
                            <td><?php echo htmlspecialchars($pago['metodo_pago'] ?? 'Transferencia'); ?></td>
                            <td>
                                <?php if ($pago['estado'] === 'pagado'): ?>
                                    <span class="badge-paid">PAGADO</span>
                                <?php else: ?>
                                    <span class="badge-pending">PENDIENTE</span>
                                <?php endif; ?>
                            </td>
                            <td style="text-align: right;">$<?php echo number_format($pago['monto'], 2); ?></td>
                        </tr>
                        <tr class="total-row">
                            <td colspan="4" style="text-align: right;">TOTAL:</td>
                            <td style="text-align: right;">$<?php echo number_format($pago['monto'], 2); ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <?php if (!empty($pago['observaciones'])): ?>
            <div class="section">
                <div class="section-title">OBSERVACIONES</div>
                <p><?php echo nl2br(htmlspecialchars($pago['observaciones'])); ?></p>
            </div>
            <?php endif; ?>

            <div class="stamp-box">
                <div class="signature-line">
                    <hr>
                    <p>Firma del Estudiante</p>
                </div>
                <div class="signature-line">
                    <hr>
                    <p>Sello y Firma de Autorización<br>Instituto Bolivariano</p>
                </div>
            </div>

            <div class="footer">
                <p><strong>Este documento es un comprobante válido de pago.</strong></p>
                <p>Para consultas, comuníquese con el Departamento de Administración.</p>
                <p>Generado el <?php echo $fecha; ?> | Sistema de Matrícula Online</p>
            </div>
        </body>
        </html>
        <?php
        return ob_get_clean();
    }

    /**
     * Genera un certificado de matrícula
     * 
     * @param array $usuario Datos del usuario
     * @param array $carrera Datos de la carrera
     * @return string HTML del certificado
     */
    public static function generarCertificadoMatricula($usuario, $carrera) {
        $fecha = date('d/m/Y');
        $año = date('Y');
        
        ob_start();
        ?>
        <!DOCTYPE html>
        <html lang="es">
        <head>
            <meta charset="UTF-8">
            <title>Certificado de Matrícula</title>
            <style>
                @page {
                    margin: 3cm;
                }
                body {
                    font-family: 'Georgia', serif;
                    font-size: 14px;
                    line-height: 2;
                    color: #000;
                    text-align: justify;
                }
                .certificate-border {
                    border: 10px double #1D327B;
                    padding: 40px;
                    min-height: 90vh;
                }
                .header {
                    text-align: center;
                    margin-bottom: 40px;
                }
                .header h1 {
                    color: #1D327B;
                    font-size: 28px;
                    margin: 20px 0 10px 0;
                    font-weight: bold;
                }
                .header h2 {
                    color: #1D327B;
                    font-size: 22px;
                    margin: 10px 0;
                }
                .certificate-title {
                    text-align: center;
                    font-size: 24px;
                    font-weight: bold;
                    color: #1D327B;
                    margin: 30px 0;
                    text-transform: uppercase;
                    letter-spacing: 2px;
                }
                .certificate-number {
                    text-align: right;
                    font-size: 12px;
                    color: #666;
                    margin-bottom: 20px;
                }
                .content {
                    margin: 40px 0;
                    font-size: 16px;
                }
                .highlighted {
                    font-weight: bold;
                    text-decoration: underline;
                }
                .footer {
                    margin-top: 80px;
                    text-align: center;
                }
                .signature-line {
                    margin-top: 80px;
                    text-align: center;
                }
                .signature-line hr {
                    width: 300px;
                    margin: 0 auto;
                    border: none;
                    border-top: 2px solid #000;
                }
                .signature-label {
                    margin-top: 10px;
                    font-weight: bold;
                }
                .seal {
                    position: absolute;
                    right: 100px;
                    bottom: 150px;
                    width: 120px;
                    height: 120px;
                    border: 3px solid #1D327B;
                    border-radius: 50%;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    font-size: 10px;
                    text-align: center;
                    color: #1D327B;
                    font-weight: bold;
                }
            </style>
        </head>
        <body>
            <div class="certificate-border">
                <div class="certificate-number">
                    Certificado N° <?php echo date('Y') . '-' . str_pad($usuario['id'], 6, '0', STR_PAD_LEFT); ?>
                </div>
                
                <div class="header">
                    <h1>INSTITUTO SUPERIOR UNIVERSITARIO BOLIVARIANO</h1>
                    <h2>MODALIDAD ONLINE</h2>
                    <p>Loja - Ecuador</p>
                </div>

                <div class="certificate-title">
                    CERTIFICADO DE MATRÍCULA
                </div>

                <div class="content">
                    <p>
                        El <strong>INSTITUTO SUPERIOR UNIVERSITARIO BOLIVARIANO</strong>, 
                        con código SENESCYT <strong>N° 123456</strong>, certifica que:
                    </p>
                    
                    <p style="text-align: center; margin: 30px 0;">
                        <span class="highlighted" style="font-size: 18px;">
                            <?php echo strtoupper(htmlspecialchars($usuario['nombres'] . ' ' . $usuario['apellidos'])); ?>
                        </span>
                    </p>

                    <p>
                        Con cédula de identidad N° <span class="highlighted"><?php echo htmlspecialchars($usuario['identificacion']); ?></span>,
                        se encuentra legalmente matriculado(a) en la carrera de 
                        <span class="highlighted"><?php echo htmlspecialchars($carrera['nombre'] ?? 'Tecnología Superior'); ?></span>,
                        correspondiente al período académico <span class="highlighted"><?php echo $año; ?></span>.
                    </p>

                    <p>
                        El/La estudiante goza de todos los derechos y obligaciones establecidos
                        en el Reglamento Interno de la Institución y la Ley Orgánica de 
                        Educación Superior (LOES).
                    </p>

                    <p>
                        Se expide el presente certificado a petición del interesado(a), 
                        para los fines que estime conveniente.
                    </p>
                </div>

                <div class="footer">
                    <p>Loja, <?php echo $fecha; ?></p>
                </div>

                <div class="signature-line">
                    <hr>
                    <p class="signature-label">Director Académico</p>
                    <p class="signature-label">Instituto Superior Universitario Bolivariano</p>
                </div>

                <div class="seal">
                    SELLO<br>INSTITUCIONAL
                </div>
            </div>
        </body>
        </html>
        <?php
        return ob_get_clean();
    }

    /**
     * Envía headers para descarga de PDF
     * 
     * @param string $filename Nombre del archivo
     */
    public static function enviarHeadersPDF($filename) {
        header('Content-Type: application/pdf');
        header('Content-Disposition: inline; filename="' . $filename . '"');
        header('Cache-Control: private, max-age=0, must-revalidate');
        header('Pragma: public');
    }

    /**
     * Convierte HTML a PDF usando navegador (print to PDF)
     * Este método genera HTML optimizado para print
     * 
     * @param string $html Contenido HTML
     * @param string $filename Nombre del archivo
     * @param bool $download Si es true, descarga. Si es false, muestra en navegador
     */
    public static function generarPDFDesdeHTML($html, $filename, $download = false) {
        if ($download) {
            header('Content-Type: text/html; charset=utf-8');
            echo '<script>window.print();</script>';
        }
        echo $html;
    }
}
