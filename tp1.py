def comprobarLongitudes(tramas):
    longitud_1 = []
    longitud_2 = []
    for trama_actual in tramas:
        #Los 2 bytes desp de la bandera los paso a decimal
        longitud_actual = int(trama_actual[2:6],16)
        longitud_1.append(longitud_actual) 

        #Longitud sin el campo bandera,checksum y longitud
        longitud_aux = len(trama_actual[6:len(trama_actual)-2])/2 #1 byte son 2 numeros hexadecimales
        longitud_2.append(longitud_aux)
    
    correctas = 0
    incorrectas = 0
    for i in range(len(longitud_1)):
        if longitud_1[i] == longitud_2[i]:
            correctas += 1
        else:
            incorrectas += 1

    return correctas,incorrectas

def sumarBytes(cadena):
    sum = 0
    for i in range(0,len(cadena)-2,2):
        sum += (int(cadena[i:i+2],16))
    
    return sum

def verificar_checkSum(tramas):

    check_sum_array = [] #Aca guardo el checksum de todas las tramas
    sum_array = []
    for trama_actual in tramas:

        checkSum_actual = trama_actual[len(trama_actual)-2:len(trama_actual)]
        check_sum_array.append(int(checkSum_actual,16))

        #suma de todos los bytes sin incluir el bit bandera y el campo longitud
        sum_array.append(sumarBytes(trama_actual[6:len(trama_actual)]))

    num_hex = int("0xFF",16) 
    correctos = 0
    incorrectos = 0
    for i in range(len(check_sum_array)):
        checkSum = num_hex - (sum_array[i] & num_hex) #Formula del trabajo practico
        if checkSum == check_sum_array[i]: 
            correctos += 1
        else:
            incorrectos += 1

    return correctos,incorrectos

archivo = open("Tramas_802-15-4.log","r")
contenido = archivo.read()

tramas = []
pos_inicial = contenido.find("7E")
longitud = len(contenido)
new_pos = 0

while (new_pos != -1):
    resto_trama = contenido[pos_inicial+2:longitud]
    # Busco el inicio de la otra trama, es decir un 7E
    new_pos = resto_trama.find("7E")
    if new_pos == -1: #Caso donde no queda otro 7E
        trama_interior = contenido[pos_inicial:longitud]
        tramas.append(trama_interior)
    else:
        """new_pos esta desplazado 2 posiciones adelante con respecto a contenido
        ya que su posicion fue calculada respecto a resto_trama"""
        trama_interior = contenido[pos_inicial:new_pos+2] 
        tramas.append(trama_interior) #Agrego toda la trama incluyendo el 7E
        contenido = contenido[new_pos+2:longitud] # Ahora mi contenido va desde el siguiente 7E hasta el final
        pos_inicial = 0 # Reseteo la posicion 





print(len(tramas))
respuestas = comprobarLongitudes(tramas)
print(f"Cantidad de longitudes correctas: {respuestas[0]}")
print(f"Cantidad de longitudes incorrectas: {respuestas[1]}")

respuestas_con_checksum = verificar_checkSum(tramas)
print(f"Cantidad de longitudes correctas con verificacion: {respuestas_con_checksum[0]}")
print(f"Cantidad de longitudes correctas sin verificacion: {respuestas_con_checksum[1]}")
