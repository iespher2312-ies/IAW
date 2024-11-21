CREATE TABLE productos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(60) UNIQUE NOT NULL,
    descripcion TEXT,
    tipo ENUM('Bazar', 'Alimentacion', 'Limpieza')
);

INSERT INTO productos (nombre, descripcion, tipo) VALUES
('Taza Cerámica Blanca', 'Taza de cerámica resistente, apta para microondas.', 'Bazar'),
('Escoba Multiuso', 'Escoba con cerdas duraderas para todo tipo de suelos.', 'Limpieza'),
('Papel Higiénico 12 Rollos', 'Papel higiénico de doble capa y gran suavidad.', 'Limpieza'),
('Arroz Largo 1kg', 'Arroz de grano largo ideal para guarniciones.', 'Alimentacion'),
('Cepillo de Dientes', 'Cepillo de dientes de cerdas suaves para uso diario.', 'Bazar'),
('Lavavajillas Líquido 500ml', 'Detergente para vajilla con aroma a limón.', 'Limpieza'),
('Aceite de Oliva Extra Virgen', 'Aceite de oliva de alta calidad, prensado en frío.', 'Alimentacion'),
('Toallas de Cocina 2 Unidades', 'Toallas absorbentes y resistentes.', 'Limpieza'),
('Chocolate con Leche 100g', 'Barra de chocolate con leche cremoso.', 'Alimentacion'),
('Plato Llano de Porcelana', 'Plato blanco clásico, ideal para comidas diarias.', 'Bazar'),
('Detergente para Ropa 1L', 'Detergente líquido para ropa de color.', 'Limpieza'),
('Cereal Integral 500g', 'Cereal saludable con alto contenido de fibra.', 'Alimentacion'),
('Esponja Abrasiva', 'Esponja con doble capa para limpieza profunda.', 'Limpieza'),
('Sartén Antiadherente 28cm', 'Sartén resistente, compatible con inducción.', 'Bazar'),
('Galletas de Avena 250g', 'Galletas crujientes hechas con avena integral.', 'Alimentacion'),
('Ambientador en Spray', 'Ambientador con fragancia floral.', 'Limpieza'),
('Bolígrafo Azul', 'Bolígrafo de tinta azul con punta fina.', 'Bazar'),
('Harina de Trigo 1kg', 'Harina de trigo todo uso.', 'Alimentacion'),
('Trapos de Microfibra', 'Paquete de 3 trapos multiuso de microfibra.', 'Limpieza'),
('Tupperware Hermético', 'Envase plástico resistente y apto para microondas.', 'Bazar'),
('Café Molido 250g', 'Café molido de tueste medio, 100% arábica.', 'Alimentacion'),
('Limpiacristales 750ml', 'Producto para dejar los cristales impecables.', 'Limpieza'),
('Vela Aromática', 'Vela con fragancia a vainilla, ideal para decorar.', 'Bazar'),
('Conservas de Atún 3x80g', 'Lata de atún en aceite de girasol.', 'Alimentacion'),
('Quitamanchas en Polvo', 'Polvo limpiador eficaz contra manchas difíciles.', 'Limpieza');
